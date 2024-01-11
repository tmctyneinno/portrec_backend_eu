<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'role', 'password', 'website',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        "industries_id",
        "allow_search"
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

  

    public function education()
    {
        return $this->hasMany(Education::class, "user_id", "id");
    }

    public function userTransactions()
    {
        return $this->hasMany(UserTransaction::class);
    }

    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function resume()
    {
        return $this->hasMany(UserResume::class);
    }

    public function interview()
    {
        return $this->hasMany(Interview::class);
    }


    public function cover_letters()
    {
        return $this->hasMany(CoverLetter::class);
    }

    public function experience()
    {
        return $this->hasMany(WorkExperience::class);
    }


    public function portfolios()
    {
        return $this->hasMany(UserPortfolio::class);
    }

    public function skill()
    {
        return $this->hasMany(AcquiredSkill::class)->select("skill_id", 'user_id');
    }
}
