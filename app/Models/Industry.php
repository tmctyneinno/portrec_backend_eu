<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = ['name', 'status'];


    public function function()
    {
        return $this->hasMany(JobFunction::class, "industry_id", "id");
    }

    public function jobs()
    {
        return $this->hasManyThrough(JobOpening::class, JobFunction::class, "industry_id", "job_functions");
    }
}
