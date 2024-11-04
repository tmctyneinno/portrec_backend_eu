<?php

namespace App\Http\Controllers\Recruiters\Trait;

use App\Models\RecruiterProfile;

trait RecruiterTrait
{
    public function RecruiterID($type = "update")
    {
        $user = auth()->user();
        $this->authorize($type, $user);
        return $user;
    }

    public function condition($id, $recruiterID)
    {
        return [["id", "=", $id], ["recruiter_id", "=",  $recruiterID]];
    }


    public function RecruiterDetails($request, $image = null)
    {
        $user = $this->RecruiterID();
        $profile = RecruiterProfile::where('id', $user->id)->first();

        if (!$profile) {
            return [
                'recruiter_level_id' => $request->recruiter_level_id ?? null,
                'image_path' => $request->image_path ?? null,
                'phone' => $request->phone ?? null,
                'availability_id' => $request->availability_id ?? null,
                'gender_id' => $request->gender_id ?? null,
                'professional_headline' => $request->professional_headline ?? null,
                'dob' => $request->dob ?? null,
                'country' => $request->country ?? null,
                'state' => $request->state ?? null,
                'address' => $request->address ?? null,
                'description' => $request->description ?? null,
            ];
        }

        return [
            'recruiter_level_id' => $request->recruiter_level_id ?? $profile->recruiter_level_id,
            'image_path' => $request->image_path ?? $profile->image_path,
            'phone' => $request->phone ?? $profile->phone,
            'availability_id' => $request->availability_id ?? $profile->availability_id,
            'gender_id' => $request->gender_id ?? $profile->gender_id,
            'professional_headline' => $request->professional_headline ?? $profile->professional_headline,
            'dob' => $request->dob ?? $profile->dob,
            'country' => $request->country ?? $profile->country,
            'state' => $request->state ?? $profile->state,
            'address' => $request->address ?? $profile->address,
            'description' => $request->description ?? $profile->description,
        ];
    }
}
