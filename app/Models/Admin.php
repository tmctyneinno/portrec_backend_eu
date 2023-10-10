<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes, HasFactory, Notifiable;
    protected $fillable = ['email', 'name', 'phone', 'password', 'login_ip', 'last_login', 'admin_type', 'admin_role', 'admin_level', 'image_path'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function role()
    {
        // $this->has
    }
}
