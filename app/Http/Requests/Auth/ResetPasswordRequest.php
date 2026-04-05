<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            * The email field is required and must be a valid email address.
            * 
            * @example
            */
            'email' => ['required', 'email'],
            /**
             * The token field is required and must be a string.
             * 
             * @example 1234567890abcdef
             */
            'token' => ['required', 'string'],
            
            /**
             * The password field is required, must be confirmed, and must be at least 8 characters long.
             * 
             * @example secret123
             */
            'password' => ['required', 'confirmed', 'min:8'],

            /**
             * The password confirmation field is required.
             * 
             * @example secret123
             */
            'password_confirmation' => ['required'],
        ];
    }
}
