<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;
    protected $fillable = ['recruiter_id', 'company_id', 'title', 'job_functions', 'qualification', 'location', 'work_type_id', 'experience', 'min_salary', 'max_salary', 'deadline', 'title', 'description', 'total_view', 'required_skills', 'other_qualifications', 'benefits'];

    protected $hidden = [
        "recruiter_id",
        "company_id",
        "job_type_id",
        "job_functions"
    ];

    public function jobType()
    {
        return $this->belongsTo(WorkType::class, "job_type_id", "id");
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function title()
    {
        return $this->belongsTo(JobFunction::class, "job_functions", "id");
    }

    public function questions()
    {
        return $this->hasMany(ApplicationQuestion::class, "job_id");
    }
}
