<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruiterTransaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['recruiter_id', 'ref', 'payment_ref', 'amount', 'reason'];
}
