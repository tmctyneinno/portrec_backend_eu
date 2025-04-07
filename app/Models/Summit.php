<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summit extends Model
{
    use HasFactory;


    protected $with = ['summit_registration'];
    protected $fillable = ['title', 'link', 'summit_date', 'content', 'is_active', 'image', 'venue'];



    public function summit_registration()
    {
        return $this->hasMany(SummitRegistration::class);
    }
}
