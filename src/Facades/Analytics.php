<?php

namespace Backstage\Analytics\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Backstage\Analytics\Analytics
 */
class Analytics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Backstage\Analytics\Analytics::class;
    }
}
