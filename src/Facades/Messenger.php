<?php

namespace Codedungeon\PHPMessenger\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Messenger
 * @package Codedungeon\PHPMessenger\Facades
 */
class Messenger extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'messenger';
    }
}
