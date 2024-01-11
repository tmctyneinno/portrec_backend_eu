<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'company_name', 'company_location', 'start_date', 'end_date', 'job_title', 'job_level', 'industries_id', 'job_function_id', 'salary_range', 'work_type_id', 'description', 'status'];
}
