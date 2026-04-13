<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
        ];
    }
}
