<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\RegisterdSellerEvent;
//added
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Log;

class RegisteredSellerListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    //copied from Illuminate/Auth/Listeners/SendEmailVerificationNotification.php
    // and modified
    public function handle(RegisterdSellerEvent $event)
    {
        Log::info('RegisterdSellerEvent::handle()');

        if ($event->seller instanceof MustVerifyEmail && ! $event->seller->hasVerifiedEmail()) {
            $event->seller->sendEmailVerificationNotification();
        }
    }

}
