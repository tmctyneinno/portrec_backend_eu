<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUploadPath extends Model
{
    use HasFactory;

    // protected $table = 'file_upload_paths';

    protected $guarded = ['id'];
}
