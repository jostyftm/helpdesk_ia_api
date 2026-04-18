<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
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
             * Subject of the ticket
             * 
             * @example Cannot access account
             */
            'subject' => ['string', 'max:255'],


            /**
             * Description of the ticket
             * 
             * @example I am unable to access my account since yesterday. I have tried resetting my password but it did not work.
             */
            'description' => ['string'],
        ];
    }
}
