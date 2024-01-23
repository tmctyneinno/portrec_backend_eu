<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'institution', 'qualifications', 'start_date', 'end_date', 'description', 'deleted_at'];
}
