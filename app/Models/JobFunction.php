<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobFunction extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'industry_id'];


    public  function jobs()
    {
        return $this->hasMany(JobOpening::class, "job_function_id", "id");
    }
}
