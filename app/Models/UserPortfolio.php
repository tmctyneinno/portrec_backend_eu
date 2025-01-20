<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model       
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'description', 'goals', 'achievements', 'project_url', 'images'];

    protected $casts = [
        'images' =>'json'
    ];

    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
