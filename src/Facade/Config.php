<?php namespace Lilie\Facade;

use Lilie\Config\Repository;
use Illuminate\Support\Facades\Facade;

class Config extends Facade {

    /**
     * Register the Pool-Repository.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Repository::class;
    }

}