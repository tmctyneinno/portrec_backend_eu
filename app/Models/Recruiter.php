<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Recruiter extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = ['name', 'email', 'password', 'phone', 'location', 'recruiter_level'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function recruiterSubscriptions()
    {
        return $this->hasMany(RecruiterSubscription::class);
    }

    public function recruiterTransactions()
    {
        return $this->hasMany(RecruiterTransaction::class);
    }

    public function recruiterCompany()
    {
        return $this->hasMany(Company::class);
    }
}
