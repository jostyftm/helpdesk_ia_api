<?php

namespace App\Http\Controllers\Api\V1\TicketSource;

use App\Http\Controllers\Controller;
use App\Models\TicketSource;
use Illuminate\Http\Request;
use App\Http\Requests\TicketSource\TicketSourceListRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Services\TicketSourceService;
use App\Http\Resources\TicketSource\TicketSourceResource;

class TicketSourceController extends Controller
{

    public function __construct(
        private readonly TicketSourceService $service,
    ) {}

    /**
     * List Soruces 
     * 
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\TicketSource\TicketSourceListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(TicketSourceListRequest $request): AnonymousResourceCollection 
    {
        $response = $this->service->index($request);

        return TicketSourceResource::collection($response);
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
    public function show(TicketSource $ticketSource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketSource $ticketSource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketSource $ticketSource)
    {
        //
    }
}
