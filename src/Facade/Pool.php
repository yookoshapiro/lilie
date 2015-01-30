<?php namespace Lilie\Facade;

use Illuminate\Support\Facades\Facade;

class Pool extends Facade {


    /**
     * Register the Pool-Repository.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Lilie\Pool\Repository::class;
    }


}