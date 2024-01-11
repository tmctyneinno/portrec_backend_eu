<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruiterTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['recruiter_id', 'ref', 'payment_ref', 'amount', 'reason'];
}
