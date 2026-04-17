<?php

namespace App\Http\Controllers\Api\V1\TicketPriority;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketPriority\TicketPriorityResource;
use App\Models\TicketPriority;
use App\Services\TicketPriorityService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketPriorityController extends Controller
{

    public function __construct(
        public readonly TicketPriorityService $service,
    ) {}

    /**
     * List all ticket priorities.
     * 
     * Display a listing of the resource.
     * 
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $priorities = $this->service->index(request: $request);

        return TicketPriorityResource::collection($priorities);
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
    public function show(TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPriority $ticketPriority)
    {
        //
    }
}
