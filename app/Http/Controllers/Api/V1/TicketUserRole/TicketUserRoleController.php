<?php

namespace App\Http\Controllers\Api\V1\TicketUserRole;

use App\Http\Controllers\Controller;
use App\Models\TicketUserRole;
use App\Services\TicketUserRoleService;
use Illuminate\Http\Request;
use App\Http\Requests\TicketUserRole\TicketUserRoleListRequest;
use App\Http\Resources\TicketUserRole\TicketUserRoleResource;

class TicketUserRoleController extends Controller
{
    public function __construct(
        protected readonly TicketUserRoleService $ticketUserRoleService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(TicketUserRoleListRequest $request)
    {
        $ticketUserRoles = $this->ticketUserRoleService->index($request);

        return TicketUserRoleResource::collection($ticketUserRoles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(TicketUserRole $ticketUserRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketUserRole $ticketUserRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketUserRole $ticketUserRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketUserRole $ticketUserRole)
    {
        //
    }
}
