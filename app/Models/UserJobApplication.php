<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserJobApplication extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'job_id', 'status', 'resume_link', 'cover_letter', 'cover_letter_link'
    ];
}
