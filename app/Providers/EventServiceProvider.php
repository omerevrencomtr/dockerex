<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        'Illuminate\Auth\Events\Registered' => [
            'App\Listeners\Auth\EventAuthRegisteredListener',
        ],

        'Illuminate\Auth\Events\Attempting' => [
            'App\Listeners\Auth\EventAuthAttemptListener',
        ],

        'Illuminate\Auth\Events\Authenticated' => [
            'App\Listeners\Auth\EventAuthAuthenticatedListener',
        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\Auth\EventAuthLoginListener',
        ],

        'Illuminate\Auth\Events\Failed' => [
            'App\Listeners\Auth\EventAuthFailedListener',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\Auth\EventAuthLogoutListener',
        ],

        'Illuminate\Auth\Events\Lockout' => [
            'App\Listeners\Auth\EventAuthLockoutListener',
        ],

        'Illuminate\Auth\Events\PasswordReset' => [
            'App\Listeners\Auth\EventAuthPasswordResetListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
