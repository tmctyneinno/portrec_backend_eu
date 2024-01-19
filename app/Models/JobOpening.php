<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;
    protected $fillable = ['recruiter_id', 'company_id', 'job_level_id', 'country_id', 'job_function_id', 'job_type_id', 'title', 'description', 'required_skills', 'min_salary', 'max_salary', 'deadline', 'qualifications', 'location', 'experience', 'total_view', 'other_qualifications', 'benefits', 'status', 'responsibilities', 'capacity', 'total_applied'];

    protected $hidden = [
        "recruiter_id",
        "company_id",
        "job_type_id",
        "job_functions"
    ];

    public function jobType()
    {
        return $this->belongsTo(JobType::class, "job_type_id", "id");
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function level()
    {
        return $this->belongsTo(JobLevel::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(JobFunction::class, "job_functions", "id");
    }





}
