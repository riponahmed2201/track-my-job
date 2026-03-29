<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'website',
        'industry',
        'company_size',
        'headquarters',
        'founded_year',
        'company_type',
        'description',
        'logo_url',
        'glassdoor_url',
        'linkedin_url',
        'average_rating',
        'total_reviews',
        'created_by',
        'updated_by',
    ];

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'company_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'company_id');
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
