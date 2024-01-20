<?php

namespace App\Listeners;

use App\Events\RegistrationEmails;
use App\Mail\RegistrationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmails implements ShouldQueue
{
    /**
     * Create the event listener.
     */


    public function __construct()
    {
    
    }

    /**
     * Handle the event.
     */
    public function handle(RegistrationEmails $events)
    {
        Mail::to($events->user['email'])->send( new RegistrationEmail($events->user));

    }
}
