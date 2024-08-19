<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'job_function_id', 'user_level_id', 'industries_id', 'job_type_id', 'languages', 'image_path', 'phone', 'availability_id', 'preference', 'salary_expectation', 'gender_id', 'professional_headline', 'years_experience', 'experience_level', 'dob', 'country', 'state', 'address', 'allow_search', 'description', 'linkedin', 'instagram', 'website', 'twitter', 'facebook', 'avatar', 'googleplus', 'location', 'about_me', 'skills'];
}
