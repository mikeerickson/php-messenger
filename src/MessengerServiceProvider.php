<?php

namespace Codedungeon\PHPMessenger;

use Illuminate\Support\ServiceProvider;

/**
 * Class MessengerServiceProvider
 * @package Codedungeon\PHPMessenger
 */
class MessengerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // left blank intentionally
    }

    public function register()
    {
        $this->app->bind('messenger', function () {
            return new Messenger();
        });
    }
}