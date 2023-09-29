<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserResume extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id', 'doc_url', 'doc_name'
    ];
}