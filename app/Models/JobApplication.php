<?php

namespace App\Models;

use App\Enums\JobApplicationStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class JobApplication extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'job_opening_id', 'resume_id', 'cover_letter', 'portfolio_links', 'hiring_stage_id', 'applied_date', 'status', 'is_viewed'];

    public function status(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                $status = match ($value) {
                    JobApplicationStatus::IN_REVIEW->name => JobApplicationStatus::IN_REVIEW->value,
                    JobApplicationStatus::INTERVIEWING->name => JobApplicationStatus::INTERVIEWING->value,
                    JobApplicationStatus::OFFERED->name => JobApplicationStatus::OFFERED->value,
                    JobApplicationStatus::SHORTLISTED->name => JobApplicationStatus::SHORTLISTED->value,
                    JobApplicationStatus::UNSUITABLE->name => JobApplicationStatus::UNSUITABLE->value,
                };

                return $status;
            }
        );
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(JobOpening::class, 'job_opening_id', 'id');
    }

    public function resume(): BelongsTo
    {
        return $this->belongsTo(UserResume::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(JobApplicationAnswer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cover_letter(): HasOneThrough
    {
        return $this->hasOneThrough(CoverLetter::class, User::class, 'id', 'id');
    }
}
