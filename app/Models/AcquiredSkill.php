<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcquiredSkill extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'skill_id', 'deleted_at'];


    public function Skills()
    {
        return $this->belongsTo(Skill::class, 'skill_id','id');
    }
}
