<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;
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
                AllowedFilter::exact('ticket_priority_id'),
                AllowedFilter::exact('ticket_category_id'),
                AllowedFilter::exact('ticket_source_id'),
                AllowedFilter::scope('state_id', 'filterByState'),
                AllowedFilter::scope('start_after', 'startBetween'),
            ],
            relationships: ['ticketPriority', 'ticketCategory', 'ticketSource', 'currentState', 'technicianResponsible.user']
        );

        return $sources;
    }
}
