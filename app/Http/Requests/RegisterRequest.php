<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:10|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(5)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'contact_number' => 'sometimes|string|nullable|max:15',
            'driving_license_number' => 'required|string|max:50',
            'driving_license_valid_from' => 'required|date',
            'profile_picture' => 'sometimes|image|nullable',
        ];
    }
}
