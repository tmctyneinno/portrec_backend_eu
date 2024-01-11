<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;
    protected $fillable = ['recruiter_id', 'company_id', 'job_level_id', 'country_id', 'job_function_id', 'job_type_id', 'title', 'description', 'required_skills', 'min_salary', 'max_salary', 'deadline', 'qualifications', 'location', 'experience', 'total_view', 'other_qualifications', 'benefits', 'status', 'responsibilities', 'capacity', 'total_applied'];
}
