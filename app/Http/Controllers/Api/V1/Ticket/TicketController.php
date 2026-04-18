<?php

namespace App\Http\Controllers\Api\V1\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketListRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use App\Http\Requests\Ticket\TicketCategorizationRequest;
use App\Http\Requests\Ticket\TicketUpdateTechnicianRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Ticket\TicketResource;
use App\Http\Requests\Ticket\TicketCreateRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\Ticket\TicketStoreResoluctionRequest;

class TicketController extends Controller
{

    public function __construct(
        protected readonly TicketService $ticketService
    ) {}

    /**
     * List all tickets.
     * 
     * Display a listing of the resource.
     * 
     * @param  TicketListRequest  $request
     * @return AnonymousResourceCollection
     */
    public function index(TicketListRequest $request): AnonymousResourceCollection
    {
        $tickets = $this->ticketService->index($request);

        return TicketResource::collection($tickets);
    }

    /**
     * Store Ticket
     * 
     * Store a newly created resource in storage.
     * 
     * @param  TicketCreateRequest  $request
     * @return JsonResource
     * @requestMediaType multipart/form-data
     */
    public function store(TicketCreateRequest $request): JsonResource
    {
        $ticket = $this->ticketService->store($request);

        return new TicketResource($ticket);
    }

    /**
     * Show Ticket
     * 
     * Display the specified resource.
     * 
     * @param  Ticket  $ticket
     * @return JsonResource
     */
    public function show(Ticket $ticket): JsonResource
    {
        $ticket = $this->ticketService->show($ticket);

        return new TicketResource($ticket);
    }

    /**
     * Update Ticket information
     * 
     * Update the specified resource in storage.
     * 
     * @param  TicketUpdateRequest  $request
     * @param  Ticket  $ticket
     * @return JsonResource
     */
    public function update(TicketUpdateRequest $request, Ticket $ticket): JsonResource
    {
        $response = $this->ticketService->update($request, $ticket);

        return new TicketResource($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    /**
     * Categorize a ticket.
     */
    public function categorization(TicketCategorizationRequest $request, Ticket $ticket): JsonResponse
    {
        $this->ticketService->categorization($request, $ticket);

        return response()->json(['message' => 'Ticket categorized successfully']);
    }


    /**
     * Assign a technician to a ticket.
     * 
     * @param  TicketUpdateTechnicianRequest  $request
     * @param  Ticket  $ticket
     * @return JsonResponse
     */
    public function assignTechnician(TicketUpdateTechnicianRequest $request, Ticket $ticket): JsonResponse
    {
        $this->ticketService->assignTechnician($request, $ticket);

        return response()->json(['message' => 'Technician assigned successfully']);
    }

    /**
     * Resolve a ticket.
     * 
     * @param  TicketStoreResoluctionRequest  $request
     * @param  Ticket  $ticket
     * @return JsonResponse
     */
    public function resolve(TicketStoreResoluctionRequest $request, Ticket $ticket): JsonResponse
    {
        $this->ticketService->resolve($request, $ticket);

        return response()->json(['message' => 'Ticket resolved successfully']);
    }
}
