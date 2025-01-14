<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'project_title', 'project_role', 'project_task', 'project_solution', 'project_url', 'images'];

    protected $casts = [
        'images' =>'json'
    ];
}
