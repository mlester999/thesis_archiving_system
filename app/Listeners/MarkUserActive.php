<?php

namespace App\Listeners;


use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MarkUserActive
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
     * @param  \IlluminateAuthEventsVerified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
       $event->user->update(['email_status' => 1]);
    }
}
