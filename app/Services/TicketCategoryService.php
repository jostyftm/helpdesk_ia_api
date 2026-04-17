<?php

namespace App\Services;

use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

class TicketCategoryService
{
    /**
      * List all ticket sources.
      * 
      * @param  Request  $request
      * @return Collection|AbstractPaginator
     */
    public function index(Request $request):Collection | AbstractPaginator
    {
        $categories = (new TicketCategory())->search(
            request: $request,
        );

        return $categories;
    }
}