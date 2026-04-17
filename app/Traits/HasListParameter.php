<?php

declare(strict_types=1);

namespace App\Traits;

trait HasListParameter
{
    public function getListParams(): array
    {
        return [
            /**
             * Enable pagination
             *
             * @example true
             */
            "paginate"          => "nullable|in:true,false",
            /**
             * Page number to retrieve when pagination is enabled.
             *
             * @example 1
             */
            'page'              => 'nullable|integer|min:1',
            /**
             * Number of items per page when pagination is enabled.
             *
             * @example 10
             */
            'limit'             => 'nullable|integer|min:1',
            /**
             * Field used to sort the results.
             *
             * @example "created_at"
             */
            'sort'              => 'nullable|string',
            /**
             * Filters applied to the result set.
             *
             * @example {  "filter[abc]": "abc" }
             */
            'filter'            => 'nullable|array',
        ];
    }
}
