<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Recruiter extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;


    protected $fillable = ['name', 'email', 'phone', 'password', 'location', 'recruiter_level'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(RecruiterProfile::class, 'recruiter_id', 'id');
    }

    public function company()
    {
        return $this->hasOneThrough(Company::class, RecruiterProfile::class, 'recruiter_id', 'id', 'id', 'company_id');
    }
}
