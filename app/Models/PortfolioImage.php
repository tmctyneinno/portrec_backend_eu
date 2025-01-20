<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'user_portfolio_id'];

    protected $casts =
    [
        'image' => 'string',
        'user_portfolio_id' => 'string'
    ];
}
