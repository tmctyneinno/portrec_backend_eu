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

    // public function profile_pic()
    // {
    //     return $this->hasOne(ProfilePicture::class);
    // }

    // public function education()
    // {
    //     return $this->hasMany(Education::class, "user_id", "id");
    // }

    // public function userTransactions()
    // {
    //     return $this->hasMany(UserTransaction::class);
    // }

    // public function userSubscriptions()
    // {
    //     return $this->hasMany(UserSubscriber::class);
    // }

    // public function resume()
    // {
    //     return $this->hasMany(UserResume::class);
    // }

    // public function interview()
    // {
    //     return $this->hasMany(Interview::class);
    // }

    // public function jobApplication()
    // {
    //     return $this->hasMany(Candidate::class);
    // }

    // public function applicationAnswer()
    // {
    //     return $this->hasManyThrough(ApplicationAnswer::class, Application::class, "user_id", "application_id", "id", "id");
    // }

    // public function applications()
    // {
    //     return $this->hasMany(Application::class);
    // }

    // public function userJobApplications()
    // {
    //     return $this->hasMany(UserJobApplication::class, "job_id", "id");
    // }

    // public function cover_letters()
    // {
    //     return $this->hasMany(CoverLetter::class);
    // }

    // public function experience()
    // {
    //     return $this->hasMany(WorkExperience::class);
    // }

    // public function userSubscription()
    // {
    //     return $this->hasOneThrough(UserSubscriber::class, UserSubscription::class, "user_id", "user_subscription_id", "id", "id");
    // }

    // public function portfolios()
    // {
    //     return $this->hasMany(Portfolio::class);
    // }

    // public function userAwards()
    // {
    //     return $this->hasMany(Award::class);
    // }

    // public function skill()
    // {
    //     return $this->hasMany(AcquiredSkill::class)->select("skill_id", 'user_id');
    // }
}
