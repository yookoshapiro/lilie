<?php namespace Lilie\Facade;

use Illuminate\Support\Facades\Facade;

class Pool extends Facade {


    /**
     * Register the pool repository.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Lilie\Pool\Repository::class;
    }


}