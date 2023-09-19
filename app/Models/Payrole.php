<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payrole extends Model
{
    use HasFactory;
    protected $fillable = ["employee_id", "basic_salary", "house_rent_allowance", "tax", "load", "allowance", "others"];
}
