<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;


    protected $table = 'user_ratings';
    protected $fillable = ['user_id', 'rating', 'reviews'];


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}


// * * * * * /usr/bin/php  /Applications/XAMPP/xamppfiles/htdocs/portrec_backend/artisan schedule:run >> /dev/null 2>&1
