<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkExperience extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'company_name', 'company_location', 'start_date', 'end_date', 'job_title', 'job_level', 'industry_id', 'job_function_id', 'salary_id', 'work_type_id', 'description', 'status'];
}