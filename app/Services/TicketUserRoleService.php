<?php

namespace App\Services;

use App\Models\TicketUserRole;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

class TicketUserRoleService
{
    /**
     * List all ticket user roles.
     * 
     * @param  Request  $request
     * @return Collection|AbstractPaginator
     */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $sources = (new TicketUserRole())->search(
            request: $request,
            filters: ['name', 'display_name'],
        );

        return $sources;
    }
}
