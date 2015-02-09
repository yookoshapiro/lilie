<?php namespace Lilie\Facade;

use Illuminate\Support\Facades\Facade;

class Config extends Facade {

    /**
     * Register the config repository.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Lilie\Config\Repository::class;
    }

}