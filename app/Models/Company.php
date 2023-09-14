<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'recruiter_id', 'name', 'cac', 'company_type_id', 'company_industry', 'website', 'address', 'phone', 'email', 'logo', 'image', 'description'
    ];
}
