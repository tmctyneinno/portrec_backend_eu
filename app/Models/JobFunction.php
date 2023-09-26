<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobFunction extends Model
{
    use HasFactory;
    protected $fillable = ['industry_id', 'name'];

    public  function jobs()
    {
        return $this->hasMany(JobOpening::class, "job_functions", "id");
    }
}
