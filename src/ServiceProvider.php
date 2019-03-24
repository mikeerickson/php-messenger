<?php

namespace Codedungeon\PHPMessenger;

/**
 * Class MessengerServiceProvider
 * @package Codedungeon\PHPMessenger
 */
class ServiceProvider extends ServiceProvider
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