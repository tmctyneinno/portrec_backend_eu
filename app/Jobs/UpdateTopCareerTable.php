<?php

namespace App\Jobs;

use App\Models\TopCareer;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateTopCareerTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        $subscription = UserSubscription::where('status', 1)->get();
        if($subscription)
        {
            foreach($subscription as $users)
            {
                TopCareer::updateOrCreate(
                    [
                        'user_id' => $users->user_id,
                        'is_promoted' => 1,
                        'subscription_id' => $users->subscription_id
                    ]
                );
            } 
           
        }


        $users = User::query()->whereHas('rating', function($query) {
            $query->where('rating',  '>', 3);
        })->get();
        if($users)
        {
            foreach($users as $user){
            TopCareer::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'is_promoted' => null,
                    'subscription_id' => null
                ]
            );
        }
        }
Log::info(['users' => $users]);
    
    }
}
