<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Status;
use App\Priority;

class TaskRequest extends FormRequest
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
            'description' => ['string', 'required', 'max:30'],
            'due_date' => ['date'],
            'status' => [Rule::enum(Status::class)],
            'priority' => [Rule::enum(Priority::class)]
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
            'description.required' => 'Kindly fill the Task description field',
            'due_date.date' => 'Invalid date',
            'status' => 'Invalid Status',
            'priority' => 'Invalid Priority'
        ];
    }
}
