<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowUpRequest extends FormRequest
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
            'job_application_id' => 'required|exists:job_applications,id',
            'user_id' => 'required|exists:users,id',
            'follow_up_date' => 'required|date',
            'follow_up_type' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message_sent' => 'nullable|string',
            'response_received' => 'nullable|string',
            'response_time_hours' => 'nullable|integer|min:0',
            'sentiment' => 'nullable|in:Positive,Neutral,Negative',
            'next_action' => 'nullable|string|max:255',
            'reminder_set' => 'boolean',
            'reminder_date' => 'nullable|date|after_or_equal:follow_up_date',
            'completed' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'job_application_id.required' => 'Application is required.',
            'job_application_id.exists' => 'Selected application does not exist.',
            'user_id.required' => 'User is required.',
            'user_id.exists' => 'Selected user does not exist.',
            'follow_up_date.required' => 'Follow-up date is required.',
            'sentiment.in' => 'Sentiment must be Positive, Neutral, or Negative.',
            'reminder_date.after_or_equal' => 'Reminder date must be on or after follow-up date.',
        ];
    }
}
