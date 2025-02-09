<?php

namespace App\Http\Resources;

use App\Models\Company;
use App\Models\Recruiter;
use App\Models\RecruiterProfile;
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

        // Getting Company_name
        $company = null;
        $recruiterProfile = RecruiterProfile::where('recruiter_id', $this->recruiter->id)->first();
        if ($recruiterProfile && $recruiterProfile->company_id) {
            $companyProfile = Company::find($recruiterProfile->company_id);
            $company = $companyProfile?->name;
        }

        return [
            'id' => $this->id,
            'is_user_read' => $this->is_user_read,
            'is_recruiter_read' => $this->is_recruiter_read,
            'user' => new UserResource($this->user),
            'recruiter' => new RecruiterResource($this->recruiter),
            'company' => $company,
            'message' => new MessageResource($this->whenLoaded('message')),
            'messages_count' => $this->whenCounted('messages'),
            'unread_messages_count' => $this->whenCounted('unread_messages'),
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'created_at' => $this->created_at,
            'deleted_at' => $this->whenLoaded('deleted_at'),
            'updated_at' => $this->whenLoaded('updated_at'),
        ];
    }
}
