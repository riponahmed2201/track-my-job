<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',           // Who added this contact
        'name',
        'designation',
        'department',
        'email',
        'phone',
        'linkedin_url',
        'whatsapp',
        'contact_type',      // "HR", "Recruiter", "Manager", "Employee", "Referral"
        'relationship',      // "Friend", "Colleague", etc.
        'notes',
        'last_contacted_date',
        'response_rate',     // "High", "Medium", "Low", "No Response"
        'helpful',
    ];

    // Relationships
    public function application()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
