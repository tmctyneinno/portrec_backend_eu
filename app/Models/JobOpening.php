<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOpening extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['recruiter_id', 'company_id', 'title', 'job_functions', 'qualification', 'location', 'work_type_id', 'experience', 'min_salary', 'max_salary', 'deadline', 'title', 'description', 'total_view', 'required_skills', 'other_qualifications', 'benefits'];
}
