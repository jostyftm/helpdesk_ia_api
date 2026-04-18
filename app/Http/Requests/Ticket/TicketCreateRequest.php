<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
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
             * ID of the ticket source
             * 
             * @example 1
             */
            'ticket_source_id' => ['required', 'integer', 'exists:ticket_sources,id'],

            /**
             * Subject of the ticket
             * 
             * @example Cannot access account
             */
            'subject' => ['required', 'string', 'max:255'],

            /**
             * Description of the ticket
             * 
             * @example I am unable to access my account since yesterday. I have tried resetting my password but it did not work.
             */
            'description' => ['required', 'string'],

            /**
             * File attachments for the ticket
             */
            'files.*' => ['file', 'max:5120'], // Max file size of 5MB
        ];
    }
}
