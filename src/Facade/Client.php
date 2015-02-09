<?php namespace Lilie\Facade;

use Illuminate\Support\Facades\Facade;

class Client extends Facade {

    /**
     * Register the client repository.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Lilie\Client\Repository::class;
    }

}