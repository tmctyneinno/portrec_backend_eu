<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['email', 'name', 'phone', 'password', 'login_ip', 'last_login', 'admin_type', 'admin_role', 'admin_level', 'image_path'];

    public function role()
    {
        // $this->has
    }
}
