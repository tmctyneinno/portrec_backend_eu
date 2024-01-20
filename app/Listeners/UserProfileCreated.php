<?php

namespace App\Listeners;

use App\Events\CreateUserProfile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\UserProfile;

class UserProfileCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateUserProfile $event)
    {
        //get user location 
        $userId = $event->user['id'];
        $UserIp = request()->ip();
        $address = json_decode(file_get_contents("http://ipinfo.io/197.210.65.32/json"));
        // $address = json_decode(file_get_contents("http://ipinfo.io/".$UserIp."/json"));
        $users = User::where('id', $userId)->first();
        UserProfile::create([
            'user_id' => $userId,
            'job_function_id' => 1,
            'user_level_id' => 1,
            'industries_id' => null,
            'job_type_id' => null,
            'language_id' => null,
            'image_path' => null,
            'phone' => $users->phone,
            'availability_id' => 1,
            'preference' => null,
            'salary_expectation' => null,
            'gender_id' => null,
            'professional_headline' => null,
            'years_experience' => null,
            'experience_level' => null,
            'dob' => null,
            'country' =>  $address->country,
            'state' => $address->country,
            'address' => $address->country,
            'allow_search' => true,
            'description' => null,
            'linkedin' => null,
            'twitter' => null,
            'facebook' => null,
            'avatar' => null,
            'googleplus' => null,
            'location' => null,
            'about_me' => null,
        ]);
    }
}
