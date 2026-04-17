<?php

namespace App\Http\Controllers\Api\V1\TicketCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketCategory\TicketCategoryListRequest;
use App\Http\Resources\TicketCategory\TicketCategoryResource;
use App\Models\TicketCategory;
use App\Services\TicketCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketCategoryController extends Controller
{

    public function __construct(
        public readonly TicketCategoryService $service,
    ) {}


    /**
     * List all ticket categories.
     * 
     * Display a listing of the resource.
     * 
     * @param  TicketCategoryListRequest  $request
     * @return AnonymousResourceCollection
     */
    public function index(TicketCategoryListRequest $request): AnonymousResourceCollection
    {
        $categories = $this->service->index(request: $request);

        return TicketCategoryResource::collection($categories);
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
    public function show(TicketCategory $ticketCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketCategory $ticketCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketCategory $ticketCategory)
    {
        //
    }
}
