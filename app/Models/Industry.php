<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];


    public function function()
    {
        return $this->hasMany(JobFunction::class, "industry_id", "id");
    }

    public function jobs()
    {
        return $this->hasMany(JobOpening::class);
    }
}
