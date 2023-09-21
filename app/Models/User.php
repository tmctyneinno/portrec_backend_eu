<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'dob', 'country', 'state', 'address', 'allow_search', 'user_level_id', 'description', 'linkedin', 'twitter', 'facebook', 'googleplus', 'language', 'title', 'location', 'about_me', 'skills', 'industries_id', 'title', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profilePic()
    {
        return $this->hasOne(ProfilePicture::class);
    }

    public function userEducation()
    {
        return $this->hasMany(Education::class);
    }

    public function userTransactions()
    {
        return $this->hasMany(UserTransaction::class);
    }

    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscriber::class);
    }

    public function userResume()
    {
        return $this->hasMany(UserResume::class);
    }

    public function interview()
    {
        return $this->hasMany(Interview::class);
    }

    public function jobApplication()
    {
        return $this->hasMany(Candidate::class);
    }

    public function applicationAnswer()
    {
        return $this->hasManyThrough(ApplicationAnswer::class, Application::class, "user_id", "application_id", "id", "id");
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function userJobApplications()
    {
        return $this->hasMany(UserJobApplication::class, "job_id", "id");
    }

    public function coverLetters()
    {
        return $this->hasMany(CoverLetter::class);
    }

    public function workExperience()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function userSkills()
    {
        return $this->hasManyThrough(AcquiredSkill::class, Skill::class, "user_id", "skill_id", "id", "id");
    }

    public function userSUbscription()
    {
        return $this->hasOneThrough(UserSubscriber::class, UserSubscription::class, "user_id", "user_subscription_id", "id", "id");
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function userAwards()
    {
        return $this->hasMany(Award::class);
    }
}
