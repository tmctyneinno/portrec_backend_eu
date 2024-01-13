<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResumeResource extends JsonResource
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
            'resume_name' => $this->resume_name,
            'resume_url' => $this->resume_url,
            'created_at' => $this->whenLoaded('created_at'),
            'updated_at' => $this->whenLoaded('updated_at'),
            'deleted_at' => $this->whenLoaded('deleted_at'),
        ];
    }
}
