<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'job_opening_id' => $this->job_opening_id,
            'hiring_stage_id' => $this->hiring_stage_id,
            'status' => $this->status,
            'is_viewed' => $this->is_viewed,
            'portfolio_links' => $this->portfolio_links,
            'applied_date' => $this->applied_date,
            'cover_letter' => $this->cover_letter,
            'user' => new UserResource($this->whenLoaded('user')),
            'resume' => new UserResumeResource($this->resume),
            'answers' => $this->whenLoaded('answers'),
            'created_at' => $this->created_at,
        ];
    }
}
