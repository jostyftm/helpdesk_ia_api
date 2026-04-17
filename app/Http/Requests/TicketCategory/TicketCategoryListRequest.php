<?php

namespace App\Http\Requests\TicketCategory;

use App\Traits\HasListParameter;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketCategoryListRequest extends FormRequest
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
             * The name of the role to filter by.
             * 
             * @example admin
             */
            'filter.name' => 'nullable|string',

            ...$this->getListParams(),
        ];
    }
}
