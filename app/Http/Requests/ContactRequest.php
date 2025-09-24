<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'linkedin_url' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'contact_type' => 'nullable|string|max:50',
            'relationship' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'last_contacted_date' => 'nullable|date',
            'response_rate' => 'nullable|in:High,Medium,Low,No Response',
            'helpful' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'Company is required.',
            'company_id.exists' => 'Selected company does not exist.',
            'user_id.required' => 'User is required.',
            'user_id.exists' => 'Selected user does not exist.',
            'name.required' => 'Contact name is required.',
            'email.email' => 'Email must be a valid email address.',
            'response_rate.in' => 'Response rate must be High, Medium, Low, or No Response.',
        ];
    }
}
