<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscriber extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_subscription_id', 'user_id', "start_date", "end_date", "status", "is_paid"];
}
