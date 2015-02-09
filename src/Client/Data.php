<?php namespace Lilie\Client;

use Lilie\Support\Collection;

class Data extends Collection {

    protected $data = [

        /**
         * The database id.
         *
         * @var     string
         **/
        'id' => null,


        /**
         * Name of the client.
         *
         * @var	    string
         **/
        'name'  => null,


        /**
         * Slug in the url.
         *
         * @var	    string
         **/
        'slug' => null,


        /**
         * Used pool.
         *
         * @var	    string|\Lilie\Pool\Pool
         **/
        'pool' => null,


        /**
         * Homepage of this client.
         *
         * @var	    int
         **/
        'root' => null

    ];

}