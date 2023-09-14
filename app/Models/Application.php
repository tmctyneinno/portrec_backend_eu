<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'job_id', 'cv_id', 'cover_letter_id', 'portfolio_links', 'hiring_stage_id', 'applied_date', 'status', 'answers', 'is_viewed'];
}
