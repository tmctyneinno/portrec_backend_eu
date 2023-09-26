<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "job_types";
    protected $fillable = ['status', 'name'];

    protected $hidden = ["created_at", "updated_at", "deleted_at"];

    public function jobs()
    {
        return $this->hasMany(JobOpening::class, "job_type_id", "id");
    }
}
