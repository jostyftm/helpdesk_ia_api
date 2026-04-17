<?php

namespace App\Services;

use App\Models\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

class TicketPriorityService
{
    /**
     * List all ticket priorities.
     * 
     * @param  Request  $request
     * @return Collection|AbstractPaginator
     */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $sources = (new TicketPriority())->search(
            request: $request,
        );

        return $sources;
    }
}
