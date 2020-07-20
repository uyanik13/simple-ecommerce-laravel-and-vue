<?php

namespace Evention\Facades;

use Evention\Core;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 *
 * @see Core
 */
class Evention extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'core';
    }
}