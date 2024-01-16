<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResume extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'resume_url', 'resume_name', 'public_id'];

    // public function resumeUrl(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => urlencode($value)
    //     );
    // }
}
