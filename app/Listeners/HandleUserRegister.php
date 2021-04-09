<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserRegisterNotification;

class HandleUserRegister
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
     * @param  UserRegister $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        $event->user->notify(new UserRegisterNotification());
    }
}
