<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Solunes\Store\App\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*'Illuminate\Auth\Events\Login' => [
            'Solunes\Master\App\Listeners\UserLoggedIn',
        ],*/
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        //$events->listen('Illuminate\Auth\Events\Login', 'Solunes\Master\App\Listeners\UserLoggedIn');

        parent::boot($events);
    }
}
