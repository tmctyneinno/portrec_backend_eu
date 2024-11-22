<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopCareer extends Model
{
    use HasFactory;


    protected $table = "top_careers";
    protected $fillable = 
    [
        'user_id',
        'industry_id',
        'is_promoted',
        'subscription_id'
    ];
}
