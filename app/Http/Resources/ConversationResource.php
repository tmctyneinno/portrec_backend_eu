<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->messages !== null) {
            return [
                'id' => $this->id,
                'is_user_read' => $this->is_user_read,
                'is_recruiter_read' => $this->is_recruiter_read,
                'user' => new UserResource($this->user),
                'recruiter' => new RecruiterResource($this->recruiter),
                'message' => new MessageResource($this->whenLoaded('message')),
                'messages_count' => $this->whenCounted('messages'),
                'messages' => MessageResource::collection($this->whenLoaded('messages')),
                'created_at' => $this->created_at,
                'deleted_at' => $this->whenLoaded('deleted_at'),
                'updated_at' => $this->whenLoaded('updated_at'),
            ];
        }
    }
}
