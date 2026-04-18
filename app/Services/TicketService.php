<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\TicketState;
use App\Models\TicketUserRole;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\AllowedFilter;

class TicketService
{
    /**
     * List all tickets.
     * 
     * @param  Request  $request
     * @return Collection|AbstractPaginator
     */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $sources = (new Ticket())->search(
            request: $request,
            filters: [
                'subject',
                'description',
                AllowedFilter::exact('id'),
                AllowedFilter::exact('ticket_priority_id'),
                AllowedFilter::exact('ticket_category_id'),
                AllowedFilter::exact('ticket_source_id'),
                AllowedFilter::scope('state_id', 'filterByState'),
                AllowedFilter::scope('start_after', 'startBetween'),
                AllowedFilter::scope('user_id', 'filterByUser'),
            ],
            relationships: ['ticketPriority', 'ticketCategory', 'ticketSource', 'currentState', 'technicianResponsible.user']
        );

        return $sources;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  Request  $request
     * @return Ticket
     */
    public function store(Request $request): Ticket
    {
        $authUser = request()->user();

        $ticket = Ticket::create($request->validated());

        $ticketState = TicketState::where('name', 'created')->first();
        $requesterCode = TicketUserRole::where('name', 'requester')->first()->id;

        $ticket->stateHistories()->attach($ticketState->id, ['is_current' => true]);
        $ticket->ticketUsers()->create([
            'user_id' => $authUser->id,
            'ticket_user_role_id' => $requesterCode,
        ]);

        $ticket->load(['ticketPriority', 'ticketCategory', 'ticketSource', 'currentState', 'technicianResponsible.user']);

        return $ticket;
    }

    /**
     * Display the specified resource.
     * 
     * @param  Ticket  $ticket
     * @return Ticket
     */
    public function show(Ticket $ticket): Ticket
    {
        $ticket->load([
            'ticketPriority',
            'ticketCategory',
            'ticketSource',
            'ticketResolutions',
            'currentState',
            'ticketUsers.user',
            'ticketUsers.role',
            'technicianResponsible.user'
        ]);

        return $ticket;
    }


    /**
     * Update the specified resource in storage.
     * 
     * @param  Request  $request
     * @param  Ticket  $ticket
     * @return Ticket
     */
    public function update(Request $request, Ticket $ticket): Ticket
    {
        $ticket->update($request->validated());

        $ticket->load(['ticketPriority', 'ticketCategory', 'ticketSource', 'currentState', 'ticketUsers.user', 'ticketUsers.role', 'technicianResponsible.user']);

        return $ticket;
    }

    /**
     * Categorize a ticket.
     * 
     * @param  Request  $request
     * @param  Ticket  $ticket
     */
    public function categorization(Request $request, Ticket $ticket): void
    {
        $ticket->update([
            'ticket_priority_id' => $request->input('ticket_priority_id'),
            'ticket_category_id' => $request->input('ticket_category_id')
        ]);
    }

    /**
     * Assign a technician to a ticket.
     * 
     * @param  Request  $request
     * @param  Ticket  $ticket
     */
    public function assignTechnician(Request $request, Ticket $ticket)
    {
        $technicians = $request->input('technicians');


        foreach ($technicians as $tech) {
            $ticket->ticketUsers()->updateOrCreate(
                ['ticket_id' => $ticket->id, 'user_id' => $tech['id']],
                ['ticket_user_role_id' => $tech['role_id']]
            );
        }

        // Update state to 'assigned' if not already assigned
        $assignedState = TicketState::where('name', 'assigned')->first();
        $currentState = $ticket->currentState()->first();

        if ($currentState->name !== 'assigned') {
            $ticket->stateHistories()->updateExistingPivot($currentState->id, ['is_current' => false]);
            $ticket->stateHistories()->attach($assignedState->id, ['is_current' => true]);
        }
    }

    /**
     * Resolve a ticket.
     * 
     * @param  Request  $request
     * @param  Ticket  $ticket
     */
    public function resolve(Request $request, Ticket $ticket): void
    {
        try {
            $resolvedState = TicketState::where('name', 'resolved')->first();
            $currentState = $ticket->currentState()->first();

            if ($currentState->name === 'resolved') {
                throw ValidationException::withMessages(['ticket' => 'Ticket is already resolved']);
            }

            DB::beginTransaction();

            $ticket->stateHistories()->updateExistingPivot($currentState->id, ['is_current' => false]);
            $ticket->stateHistories()->attach($resolvedState->id, ['is_current' => true]);

            $ticket->ticketResolutions()->create([
                'description' => $request->input('description'),
                'resolved_by' => request()->user()->id,
                'resolved_at' => now(),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages(['ticket' => 'An error occurred while resolving the ticket']);
        }
    }
}
