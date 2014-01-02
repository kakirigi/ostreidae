<?php namespace Orchestra\Story\Facades;

use Illuminate\Support\Facades\Facade;

class Story extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kakirigi.ostreidae';
    }
}
