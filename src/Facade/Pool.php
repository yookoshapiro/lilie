<?php namespace Lilie\Facade;

use Lilie\Pool\Repository;
use Illuminate\Support\Facades\Facade;

class Pool extends Facade {


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