<?php

namespace App\Http\Controllers\User\Trait;

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

	public function UserDetails($request, $image=null){
		$user = $this->UserID();
		$profile = UserProfile::where('id', $user->id)->first();
		return [
			'job_function_id' => isset($request->job_function_id) ? $request->job_function_id:$profile->job_function_id,
            'industries_id' => isset($request->industries_id)?$request->industries_id:$profile->industries_id,
            'job_type_id' => isset($request->job_type_id)?$request->job_type_id:$request->job_type_id,
            'language_id' => isset($request->language_id)?$request->language_id:$request->language_id,
            'image_path' => isset($image)?$image:$profile->image_path,
            'phone' => isset($request->phone)?$request->phone:$profile->phone,
            'availability_id' => isset($request->availability_id)?$request->availability_id:$profile->availability_id,
            'preference' => isset($request->preference)?$request->preference:$profile->preference,
            'salary_expectation' => isset($request->salary_expectation)?$request->salary_expectation:$profile->salary_expectation,
            'gender_id' => isset($request->gender_id)?$request->gender_id:$profile->gender_id,
            'professional_headline' => isset($request->professional_headline)?$request->professional_headline:$profile->professional_headline,
            'years_experience' => isset($request->years_experience)?$request->years_experience:$profile->years_experience,
            'experience_level' => isset($request->experience_level)?$request->experience_level:$profile->experience_level,
            'dob'=> isset($request->dob)?$request->dob:$profile->dob,
			'country' => isset($request->country)?$request->country:$profile->country,
            'state' => isset($request->state)?$request->state:$profile->dob,
            'address' => isset($request->address)?$request->address:$profile->address,
            'allow_search' => isset($request->allow_search)?$request->allow_search:$profile->allow_search,
            'description' => isset($request->description)?$request->description:$profile->description,
            'linkedin' => isset($request->linkedin)?$request->linkedin:$profile->linkedin,
            'twitter' => isset($request->twitter)?$request->twitter:$profile->twitter,
            'facebook' => isset($request->facebook)?$request->facebook:$profile->facebook,
            'avatar' => isset($request->avatar)?$request->avatar:$profile->avatar,
            'googleplus' => isset($request->googleplus)?$request->googleplus:$profile->googleplus,
            'location' => isset($request->location)?$request->location:$profile->location,
            'about_me' => isset($request->about_me)?$request->about_me:$profile->about_me,
		];
	}
}
