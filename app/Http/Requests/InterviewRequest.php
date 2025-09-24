<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
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
            'interview_round' => 'nullable|integer|min:1',
            'interview_type' => 'nullable|string|max:100',
            'interviewer_name' => 'nullable|string|max:255',
            'interviewer_designation' => 'nullable|string|max:255',
            'scheduled_date' => 'nullable|date',
            'duration_minutes' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'meeting_link' => 'nullable|url|max:500',
            'interview_format' => 'nullable|string|max:50',
            'preparation_notes' => 'nullable|string',
            'questions_asked' => 'nullable|string',
            'my_answers' => 'nullable|string',
            'technical_topics' => 'nullable|string',
            'coding_problems' => 'nullable|string',
            'interview_feedback' => 'nullable|string',
            'interviewer_feedback' => 'nullable|string',
            'outcome' => 'nullable|in:Passed,Failed,Pending,Rescheduled',
            'confidence_level' => 'nullable|integer|between:1,5',
            'difficulty_level' => 'nullable|integer|between:1,5',
            'overall_experience' => 'nullable|integer|between:1,5',
            'next_round_scheduled' => 'boolean',
            'follow_up_required' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'job_application_id.required' => 'Application is required.',
            'job_application_id.exists' => 'Selected application does not exist.',
            'meeting_link.url' => 'Meeting link must be a valid URL.',
            'outcome.in' => 'Outcome must be Passed, Failed, Pending, or Rescheduled.',
            'confidence_level.between' => 'Confidence level must be between 1 and 5.',
            'difficulty_level.between' => 'Difficulty level must be between 1 and 5.',
            'overall_experience.between' => 'Overall experience must be between 1 and 5.',
        ];
    }
}
