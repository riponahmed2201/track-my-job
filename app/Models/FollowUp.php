<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = [
        'job_application_id',
        'user_id',
        'follow_up_date',
        'follow_up_type',      // "Email", "Phone Call", "LinkedIn Message", etc.
        'contact_person',
        'subject',
        'message_sent',
        'response_received',
        'response_time_hours',
        'sentiment',           // "Positive", "Neutral", "Negative"
        'next_action',
        'reminder_set',
        'reminder_date',
        'completed',
    ];

    protected $casts = [
        'follow_up_date' => 'date',
        'reminder_date' => 'date',
    ];

    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
