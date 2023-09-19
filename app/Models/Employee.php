<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee_id", "company_id", "recruiter_id", "employee_department_id", "first_name", "last_name", "email", "phone", "employee_role_id", "username", "facenook", "twitter", "linkedin", "instagram", "image_path", "password"
    ];
}
