<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'job_application_id',
        'interview_round',
        'interview_type',          // "Phone Screen", "Technical", etc.
        'interviewer_name',
        'interviewer_designation',
        'scheduled_date',
        'duration_minutes',
        'location',                // "Video Call", "Phone", etc.
        'meeting_link',
        'interview_format',        // "Behavioral", "Technical", etc.
        'preparation_notes',
        'questions_asked',
        'my_answers',
        'technical_topics',
        'coding_problems',
        'interview_feedback',
        'interviewer_feedback',
        'outcome',                 // "Passed", "Failed", "Pending", "Rescheduled"
        'confidence_level',
        'difficulty_level',
        'overall_experience',
        'next_round_scheduled',
        'follow_up_required',
    ];

    // Relationships
    public function application()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }
}
