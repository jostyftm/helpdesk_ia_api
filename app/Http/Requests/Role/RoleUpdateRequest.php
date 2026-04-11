<?php

namespace App\Http\Requests\Role;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
             * The name of the role.
             * 
             * @example admin
             */
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $this->route('role')->id],

            /**
             * Description of the role.
             * 
             * @example Administrator role with full access to all resources.
             */
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
