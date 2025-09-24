<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'company_id' => 'nullable|exists:companies,id',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'job_url' => 'nullable|url|max:500',
            'salary_range_min' => 'nullable|integer|min:0',
            'salary_range_max' => 'nullable|integer|min:0|gte:salary_range_min',
            'currency' => 'nullable|string|max:10',
            'location' => 'nullable|string|max:255',
            'work_type' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'application_date' => 'nullable|date',
            'application_deadline' => 'nullable|date|after_or_equal:application_date',
            'application_status' => 'required|in:applied,under_review,phone_screen,technical_test,interview,final_interview,offer,accepted,rejected,withdrawn',
            'priority' => 'required|in:low,medium,high',
            'source' => 'nullable|string|max:255',
            'referral_contact' => 'nullable|string|max:255',
            'cover_letter_sent' => 'boolean',
            'portfolio_sent' => 'boolean',
            'expected_salary' => 'nullable|integer|min:0',
            'notice_period' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'last_follow_up_date' => 'nullable|date',
            'next_follow_up_date' => 'nullable|date|after_or_equal:last_follow_up_date',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'job_title.required' => 'Job title is required.',
            'job_description.required' => 'Job description is required.',
            'salary_range_max.gte' => 'Maximum salary must be greater than or equal to minimum salary.',
            'application_deadline.after_or_equal' => 'Application deadline must be on or after application date.',
            'next_follow_up_date.after_or_equal' => 'Next follow-up date must be on or after last follow-up date.',
        ];
    }
}
