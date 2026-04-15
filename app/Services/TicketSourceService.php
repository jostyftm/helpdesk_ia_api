<?php

namespace App\Services;

use App\Models\TicketSource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

class TicketSourceService
{
    /**
     * List all ticket sources.
      * 
      * @param  Request  $request
      * @return Collection|AbstractPaginator
     */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $sources = (new TicketSource())->search(
            request: $request,
        );

        return $sources;
    }
}