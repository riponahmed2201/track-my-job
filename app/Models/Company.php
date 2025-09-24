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
}
