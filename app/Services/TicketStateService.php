<?php

namespace App\Services;

use App\Models\TicketState;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

class TicketStateService
{
    /**
     * List all ticket states.
     * 
     * @param  Request  $request
     * @return Collection|AbstractPaginator
     */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $sources = (new TicketState())->search(
            request: $request,
        );

        return $sources;
    }
}
