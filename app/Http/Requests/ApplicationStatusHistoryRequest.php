<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationStatusHistoryRequest extends FormRequest
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
        $statuses = [
            'applied',
            'under_review',
            'phone_screen',
            'technical_test',
            'interview',
            'final_interview',
            'offer',
            'accepted',
            'rejected',
            'withdrawn'
        ];

        return [
            'job_application_id' => 'nullable|exists:job_applications,id',
            'previous_status' => 'required|in:' . implode(',', $statuses),
            'new_status' => 'required|in:' . implode(',', $statuses),
            'notes' => 'nullable|string',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'previous_status.required' => 'Previous status is required.',
            'previous_status.in' => 'Previous status is invalid.',
            'new_status.required' => 'New status is required.',
            'new_status.in' => 'New status is invalid.',
            'job_application_id.exists' => 'Selected job application does not exist.',
            'created_by.exists' => 'Selected creator user does not exist.',
            'updated_by.exists' => 'Selected updater user does not exist.',
        ];
    }
}
