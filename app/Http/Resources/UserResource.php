<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'deleted_at' => $this->whenLoaded('deleted_at'),
            'updated_at' => $this->whenLoaded('updated_at'),
            'profile' => $this->whenLoaded('profile'),
        ];
    }
}
