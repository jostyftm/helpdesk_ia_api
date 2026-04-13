<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => ['required','string','email','max:255','unique:users'],

            /**
             * Password for the user.
             * 
             * @example password123
             */
            'password' => ['required','string','min:8', 'confirmed'],

            /**
             * Confirmation of the password.
             * 
             * @example password123
             */
            'password_confirmation' => ['required','string','min:8'],

            /**
             * Role id to assign to the user.
             * 
             * @example 1
             */
            'role_id' => ['required','exists:roles,id'],
        ];
    }
}
