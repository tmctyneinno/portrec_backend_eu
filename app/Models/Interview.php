<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'recruiter_id', 'application_id', 'assigned_to', 'channel', 'location', 'interview_date', 'status'];
}
