<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'project_title', 'project_role', 'projecct_task', 'project_solution', 'project_url', 'images'];

    public function image()
    {
        $this->hasMany(PortfolioImage::class, "portfolio_id", "id");
    }
}