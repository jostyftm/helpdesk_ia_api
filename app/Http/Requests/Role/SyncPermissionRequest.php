<?php

namespace App\Http\Requests\Role;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SyncPermissionRequest extends FormRequest
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
             * The permissions field is required and must be an array. Each element of the array should be a valid permission ID.
             * 
             * 
             */
            'permissions' => ['required', 'array'],

            /**
             * Each permission ID must be an integer and exist in the permissions table.
             * 
             * 
             */
            'permissions.*.id' => ['integer', 'exists:permissions,id'],
        ];
    }
}
