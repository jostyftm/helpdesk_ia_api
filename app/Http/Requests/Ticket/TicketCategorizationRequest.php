<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketCategorizationRequest extends FormRequest
{
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
             * Validate that ticket_category_id is required and exists in the ticket_categories table
             * 
             * @example 1
             */
            'ticket_category_id' => ['required', 'exists:ticket_categories,id'],

            /**
             * Validate that ticket_priority_id is required and exists in the ticket_priorities table
             * 
             * @example 1
             */
            'ticket_priority_id' => ['required', 'exists:ticket_priorities,id'],
        ];
    }
}
