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

    public function UserProfile()
    {
      return  $this->hasOneThrough(UserProfile::class, User::class, 'id', 'user_id', 'user_id','id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->with('cover_letter', 'skill', 'profile');
    }

   
}
