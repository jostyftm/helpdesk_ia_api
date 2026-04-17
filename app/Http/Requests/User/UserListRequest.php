<?php

namespace App\Http\Requests\User;

use App\Traits\HasListParameter;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
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

            /**
             * The last name of the user to filter by.
             * 
             * @example Doe
             */
            'filter.last_name' => 'nullable|string',

            /**
             * The email of the user to filter by.
             * 
             * @example jhondoe@mail.com
             */
            'filter.email' => 'nullable|string',

            /**
             * The role id of the user to filter by.
             * 
             * @example 1
             */
            'filter.role_id' => ['nullable', 'integer', 'exists:roles,id'],

            ...$this->getListParams(),
        ];
    }
}
