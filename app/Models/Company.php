<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['recruiter_id', 'industry_id', 'name', 'company_size_id', 'country', 'city', 'cac', 'company_type_id', 'website', 'address', 'phone', 'email', 'logo', 'image', 'description', 'about', 'employee', 'date_founded', 'tech_stack', 'instagram', 'twitter', 'facebook', 'youtube', 'linkdin'];

    public function recruiter(){
        return $this->belongsTo(Recruiter::class, 'recruiter_id', 'id');
    }

    public function jobs(){
        return $this->hasMany(JobOpening::class, 'company_id', 'id');
    }

    public function sizes(){
        return $this->belongsTo(CompanySize::class, 'company_size_id', 'id');
    }

    public function industries(){
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
}
