<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_ref', 'external_ref', 'status', 'amount', 'channel', 'user_subscription_id'];
}
