<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateTechnicianRequest extends FormRequest
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
             * Validate that technicians is a required array
             */
            'technicians' => ['required', 'array'],

            /**
             * Validate each technician's ID exists in the users table
             * 
             */
            'technicians.*.id' => ['required', 'exists:users,id'],

            /**
             * Validate each technician's role ID exists in the ticket_user_roles table
             * 
             */
            'technicians.*.role_id' => ['required', 'exists:ticket_user_roles,id'],
        ];
    }
}
