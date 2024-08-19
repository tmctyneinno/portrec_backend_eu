<?php

namespace App\Http\Controllers\Users\Trait;

use App\Models\UserProfile;

trait UserTrait
{
    public function userID($type = "update")
    {
        $user = auth()->user();
        $this->authorize($type, $user);
        return $user;
    }

    public function condition($id, $userId)
    {
        return [["id", "=", $id], ["user_id", "=",  $userId]];
    }



    public function UserDetails($request, $image = null)
    {
        $user = $this->UserID();
        $profile = UserProfile::where('user_id', $user->id)->first();

        if (!$profile) {
            return [
                'job_function_id' => $request->job_function_id ?? null,
                'industries_id' => $request->industries_id ?? null,
                'job_type_id' => $request->job_type_id ?? null,
                'languages' => $request->languages ?? null,
                'image_path' => $image ?? null,
                'phone' => $request->phone ?? null,
                'availability_id' => $request->availability_id ?? null,
                'preference' => $request->preference ?? null,
                'salary_expectation' => $request->salary_expectation ?? null,
                'gender_id' => $request->gender_id ?? null,
                'professional_headline' => $request->professional_headline ?? null,
                'years_experience' => $request->years_experience ?? null,
                'experience_level' => $request->experience_level ?? null,
                'dob' => $request->dob ?? null,
                'country' => $request->country ?? null,
                'state' => $request->state ?? null,
                'address' => $request->address ?? null,
                'allow_search' => $request->allow_search ?? null,
                'description' => $request->description ?? null,
                'linkedin' => $request->linkedin ?? null,
                'instagram' => $request->instagram ?? null,
                'website' => $request->website ?? null,
                'twitter' => $request->twitter ?? null,
                'facebook' => $request->facebook ?? null,
                'avatar' => $request->avatar ?? null,
                'googleplus' => $request->googleplus ?? null,
                'location' => $request->location ?? null,
                'about_me' => $request->about_me ?? null,
            ];
        }

        return [
            'job_function_id' => $request->job_function_id ?? $profile->job_function_id,
            'industries_id' => $request->industries_id ?? $profile->industries_id,
            'job_type_id' => $request->job_type_id ?? $profile->job_type_id,
            'languages' => $request->languages ?? $profile->languages,
            'image_path' => $image ?? $profile->image_path,
            'phone' => $request->phone ?? $profile->phone,
            'availability_id' => $request->availability_id ?? $profile->availability_id,
            'preference' => $request->preference ?? $profile->preference,
            'salary_expectation' => $request->salary_expectation ?? $profile->salary_expectation,
            'gender_id' => $request->gender_id ?? $profile->gender_id,
            'professional_headline' => $request->professional_headline ?? $profile->professional_headline,
            'years_experience' => $request->years_experience ?? $profile->years_experience,
            'experience_level' => $request->experience_level ?? $profile->experience_level,
            'dob' => $request->dob ?? $profile->dob,
            'country' => $request->country ?? $profile->country,
            'state' => $request->state ?? $profile->state,
            'address' => $request->address ?? $profile->address,
            'allow_search' => $request->allow_search ?? $profile->allow_search,
            'description' => $request->description ?? $profile->description,
            'linkedin' => $request->linkedin ?? $profile->linkedin,
            'instagram' => $request->instagram ?? $profile->instagram,
            'website' => $request->website ?? $profile->website,
            'twitter' => $request->twitter ?? $profile->twitter,
            'facebook' => $request->facebook ?? $profile->facebook,
            'avatar' => $request->avatar ?? $profile->avatar,
            'googleplus' => $request->googleplus ?? $profile->googleplus,
            'location' => $request->location ?? $profile->location,
            'about_me' => $request->about_me ?? $profile->about_me,
        ];
    }




    //     public function UserDetails($request, $image = null)
    //     {
    //         $user = $this->UserID();
    //         $profile = UserProfile::where('id', $user->id)->first();
    //         return [
    //             'job_function_id' => isset($request->job_function_id) ? $request->job_function_id : $profile->job_function_id,
    //             'industries_id' => isset($request->industries_id) ? $request->industries_id : $profile->industries_id,
    //             'job_type_id' => isset($request->job_type_id) ? $request->job_type_id : $request->job_type_id,
    //             'language_id' => isset($request->language_id) ? $request->language_id : $request->language_id,
    //             'image_path' => isset($image) ? $image : $profile->image_path,
    //             'phone' => isset($request->phone) ? $request->phone : $profile->phone,
    //             'availability_id' => isset($request->availability_id) ? $request->availability_id : $profile->availability_id,
    //             'preference' => isset($request->preference) ? $request->preference : $profile->preference,
    //             'salary_expectation' => isset($request->salary_expectation) ? $request->salary_expectation : $profile->salary_expectation,
    //             'gender_id' => isset($request->gender_id) ? $request->gender_id : $profile->gender_id,
    //             'professional_headline' => isset($request->professional_headline) ? $request->professional_headline : $profile->professional_headline,
    //             'years_experience' => isset($request->years_experience) ? $request->years_experience : $profile->years_experience,
    //             'experience_level' => isset($request->experience_level) ? $request->experience_level : $profile->experience_level,
    //             'dob' => isset($request->dob) ? $request->dob : $profile->dob,
    //             'country' => isset($request->country) ? $request->country : $profile->country,
    //             'state' => isset($request->state) ? $request->state : $profile->dob,
    //             'address' => isset($request->address) ? $request->address : $profile->address,
    //             'allow_search' => isset($request->allow_search) ? $request->allow_search : $profile->allow_search,
    //             'description' => isset($request->description) ? $request->description : $profile->description,
    //             'linkedin' => isset($request->linkedin) ? $request->linkedin : $profile->linkedin,
    //             'twitter' => isset($request->twitter) ? $request->twitter : $profile->twitter,
    //             'facebook' => isset($request->facebook) ? $request->facebook : $profile->facebook,
    //             'avatar' => isset($request->avatar) ? $request->avatar : $profile->avatar,
    //             'googleplus' => isset($request->googleplus) ? $request->googleplus : $profile->googleplus,
    //             'location' => isset($request->location) ? $request->location : $profile->location,
    //             'about_me' => isset($request->about_me) ? $request->about_me : $profile->about_me,
    //         ];
    //     }
}
