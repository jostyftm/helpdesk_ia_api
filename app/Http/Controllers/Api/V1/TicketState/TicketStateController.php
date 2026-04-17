<?php

namespace App\Http\Controllers\Api\V1\TicketState;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketState\TicketStateListRequest;
use App\Models\TicketState;
use App\Services\TicketStateService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\TicketState\TicketStateResource;

class TicketStateController extends Controller
{
    public function __construct(
        public readonly TicketStateService $service,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(TicketStateListRequest $request): AnonymousResourceCollection
    {
        $sources = $this->service->index($request);

        return TicketStateResource::collection($sources);
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
    public function show(TicketState $ticketState)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketState $ticketState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketState $ticketState)
    {
        //
    }
}
