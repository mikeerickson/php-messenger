<?php

namespace Codedungeon\PHPMessenger\Facades;

use Illuminate\Support\Facades\Facade;

// msg:string, [label:string - optional]

/**
 * Class Messenger
 * @package Codedungeon\PHPMessenger\Facades
 * @method static string log(string $message, string $label = null)
 * @method static string info(string $message, string $label = null)
 * @method static string debug(string $message, string $label = null)
 * @method static string critical(string $message, string $label = null)
 * @method static string error(string $message, string $label = null)
 * @method static string success(string $message, string $label = null)
 * @method static string warning(string $message, string $label = null)
 * @method static string warn(string $message, string $label = null)
 * @method static string important(string $message, string $label = null)
 * @method static string status(string $message, string $label = null)
 * @method static string notice(string $message, string $label = null)
 * @method static string version()
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
