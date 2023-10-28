<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'job_id', 'cv_id', 'cover_letter_id', 'portfolio_links', 'hiring_stage_id', 'applied_date', 'status', 'is_viewed'];

    protected $hidden = ["job_id", "cv_id", "cover_letter_id", "answers"];

    public function answer()
    {
        return $this->hasMany(ApplicationAnswer::class);
    }

    public function job()
    {
        return $this->belongsTo(JobOpening::class);
    }

    public function resume()
    {
        return $this->hasOne(UserResume::class, "id", "cv_id");
    }

    public function cover_letter()
    {
        return $this->hasOne(CoverLetter::class, "id", "cover_letter_id");
    }
}
