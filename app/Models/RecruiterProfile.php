<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruiterProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'recruiter_id',
        'company_id',
        'recruiter_level_id',
        'image_path',
        'phone',
        'availability_id',
        'gender_id',
        'professional_headline',
        'dob',
        'country',
        'state',
        'address',
        'description'
    ];
}
