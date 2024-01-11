<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'job_opening_id', 'resume_id', 'cover_letter', 'portfolio_links', 'hiring_stage_id', 'applied_date', 'status', 'is_viewed'];
}
