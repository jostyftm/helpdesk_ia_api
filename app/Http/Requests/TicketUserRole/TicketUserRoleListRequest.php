<?php

namespace App\Http\Requests\TicketUserRole;

use App\Traits\HasListParameter;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketUserRoleListRequest extends FormRequest
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
             * 
             */
            'filter[name]' => ['sometimes', 'string'],
            /**
             * 
             */
            'filter[display_name]' => ['sometimes', 'string'],

            ...$this->getListParams(),
        ];
    }
}
