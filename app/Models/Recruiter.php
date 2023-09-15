<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruiter extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'email', 'password', 'phone', 'location', 'recruiter_level'];

    protected $hidden = ['password'];


    public function recruiterJobs()
    {
    }

    public function recruiterSubscriptions()
    {
    }

    public function recruiterTransactions()
    {
    }

    public function recruiterCompany()
    {
        return $this->belongsTo(Company::class);
    }
}
