<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcquiredSkill extends Model
{
    use HasFactory;
    protected $fillable = ['user_id',  'skill_id'];

    public function skill()
    {
        $this->belongsTo(Skill::class);
    }
}

// skill_id 