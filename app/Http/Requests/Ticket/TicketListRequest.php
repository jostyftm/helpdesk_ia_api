<?php

namespace App\Http\Requests\Ticket;

use App\Traits\HasListParameter;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketListRequest extends FormRequest
{
    use HasListParameter;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /**
             * Allow filtering by id
             * 
             * @example 1
             */
            'filter.id' => ['sometimes', 'integer'],

            /**
             * Allow filtering by user_id
             * 
             * @example 1
             */
            'filter.user_id' => ['sometimes', 'integer', 'exists:users,id'],

            /**
             * Allow filtering by subject
             * 
             * @example subject
             */
            'filter.subject' => ['sometimes', 'string'],

            /**
             * Allow filtering by description
             * 
             * @example description
             */
            'filter.description' => ['sometimes', 'string'],

            /**
             * Allow filtering by priority_id
             * 
             * @example 2
             */
            'filter.ticket_priority_id' => ['sometimes', 'string', 'exists:ticket_priorities,id'],

            /**
             * Allow filtering by category_id
             * 
             * @example 1
             */
            'filter.ticket_category_id' => ['sometimes', 'string', 'exists:ticket_categories,id'],

            /**
             * Allow filtering by ticket_source_id
             * 
             * @example 3
             */
            'filter.ticket_source_id' => ['sometimes', 'string', 'exists:ticket_sources,id'],

            /**
             * Allow filtering by start_after
             * 
             * @example 2024-01-01
             */
            'filter.start_after' => ['sometimes', 'string', function ($attribute, $value, $fail) {
                $dates = explode(',', $value);
                if (count($dates) > 2) {
                    $fail('The ' . $attribute . ' filter must be a valid date or date range.');
                }

                foreach ($dates as $date) {
                    if (!strtotime($date)) {
                        $fail('The ' . $attribute . ' filter must be a valid date or date range.');
                    }
                }
            }],

            ...$this->getListParams(),
        ];
    }
}
