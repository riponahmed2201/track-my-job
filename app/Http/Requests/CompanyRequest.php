<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'headquarters' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'company_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo_url' => 'nullable|url|max:255',
            'glassdoor_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'total_reviews' => 'nullable|integer|min:0',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'website.url' => 'Website must be a valid URL.',
            'logo_url.url' => 'Logo URL must be a valid URL.',
            'glassdoor_url.url' => 'Glassdoor URL must be a valid URL.',
            'linkedin_url.url' => 'LinkedIn URL must be a valid URL.',
            'founded_year.min' => 'Founded year must be a valid year.',
            'founded_year.max' => 'Founded year cannot be in the future.',
            'average_rating.max' => 'Average rating cannot exceed 5.',
        ];
    }
}
