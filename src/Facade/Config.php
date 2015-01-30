<?php namespace Lilie\Facade;

use Illuminate\Support\Facades\Facade;

class Config extends Facade {

    /**
     * Register the Pool-Repository.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Lilie\Config\Repository::class;
    }

}