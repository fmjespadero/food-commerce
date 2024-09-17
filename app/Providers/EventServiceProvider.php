<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\AssignDefaultRole;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected $listen = [
        Registered::class => [
            AssignDefaultRole::class,
        ],
    ];
}