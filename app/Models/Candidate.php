<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'work_type_id', 'location', 'image_path', 'phone', 'availability_id', 'preference', 'salary_expectation', 'language_id', 'job_function_id', 'gender_id', 'professional_headlline', 'years_experience', 'experience_leverl'];
}
