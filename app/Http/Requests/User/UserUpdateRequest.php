<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
             * User name.
             * 
             * @example John
             */
            'name' => ['required','string','max:255'],

            /**
             * User last name.
             * 
             * @example Doe
             */
            'last_name' => ['required','string','max:255'],

            /**
             * User email.
             * 
             * @example john.doe@example.com
             */
            'email' => ['required','string','email','max:255','unique:users,email,' . $this->route('user')->id],

            /**
             * Role id to assign to the user.
             * 
             * @example 1
             */
            'role_id' => ['required','exists:roles,id'],
        ];
    }
}
