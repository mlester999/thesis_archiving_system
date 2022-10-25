<?php

namespace App\Providers;

use App\Listeners\MarkUserActive;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use App\Events\AdminRegisterMailEvent;
use Illuminate\Auth\Events\Registered;
use App\Listeners\AdminRegisterMailListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        AdminRegisterMailEvent::class => [
            AdminRegisterMailListener::class
        ],

        Verified::class => [
            MarkUserActive::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
