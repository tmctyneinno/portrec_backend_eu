<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruiterSubscription extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["subscription_id", "recruiter_id", "start_date", "end_date", "status", "is_paid"];
}
