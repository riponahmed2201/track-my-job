<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'job_title',
        'job_description',
        'job_url',
        'salary_range_min',
        'salary_range_max',
        'currency',
        'location',
        'work_type',
        'employment_type',
        'application_date',
        'application_deadline',
        'application_status',
        'priority',
        'source',
        'referral_contact',
        'cover_letter_sent',
        'portfolio_sent',
        'expected_salary',
        'notice_period',
        'notes',
        'last_follow_up_date',
        'next_follow_up_date',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
