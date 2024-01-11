<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['recruiter_id', 'job_opening_id', 'questions', 'answers'];
}
