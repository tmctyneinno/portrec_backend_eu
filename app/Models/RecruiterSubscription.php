<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruiterSubscription extends Model
{
    use HasFactory;
    protected $fillable = ['subscription_id', 'recruiter_id', 'start_date', 'end_date', 'status', 'is_paid'];
}
