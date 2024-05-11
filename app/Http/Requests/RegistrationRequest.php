<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\Rules\Phone;


class RegistrationRequest extends FormRequest
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
            'name' => ['string', 'required', 'min:3'],
            'email' => ['string', 'required', 'email:filter', 'unique:users'],
            'phone' => "required|phone:NG",
            'password' => ['required', 'min:8', 'confirmed']
        ];
    }

    /**
     * Set validation error messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kindly fill the name field',
            'name.string' => 'Invalid name',
            'name.min:3' => 'Name must be at least 3 letters',
            'phone.required' => 'Kindly fill in your phone number',
            'phone' => 'Invalid phone number',
            'password.required' => 'Password is required',
            'password.min:8' => 'Password must be at least 8 letters'
        ];
    }
}
