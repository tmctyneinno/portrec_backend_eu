<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use function Laravel\Prompts\select;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'dob', 'country', 'state', 'address', 'allow_search', 'user_level_id', 'description', 'linkedin', 'twitter', 'facebook', 'googleplus', 'language', 'title', "instagram", 'location', 'about_me', 'skills', 'industries_id', 'title', 'role', 'password', 'website',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        "industries_id",
        "allow_search"
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

    public function profile_pic()
    {
        return $this->hasOne(ProfilePicture::class);
    }

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
        return $this->hasMany(UserSubscriber::class);
    }

    public function resume()
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

    public function cover_letters()
    {
        return $this->hasMany(CoverLetter::class);
    }

    public function experience()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function userSubscription()
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

    public function skill()
    {
        return $this->hasMany(AcquiredSkill::class)->select("skill_id", 'user_id');
    }
}
