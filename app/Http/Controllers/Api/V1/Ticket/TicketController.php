<?php

namespace App\Http\Controllers\Api\V1\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketListRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Ticket\TicketResource;

class TicketController extends Controller
{

    public function __construct(
        public readonly TicketService $ticketService
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
