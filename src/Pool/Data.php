<?php namespace Lilie\Pool;

use Lilie\Support\Collection;

class Data extends Collection {

    protected $data = [

        /**
         * The class library in this pool.
         *
         * @var string
         **/
        'lib' => null,


        /**
         * Namespace of a library.
         *
         * @var	array
         **/
        'namespace' => null,


        /**
         * Folder with all page types of this pool.
         *
         * @var	string
         **/
        'types' => null,


        /**
         * Start up files.
         *
         * @var	array
         **/
        'files' => array(),


        /**
         * A array for some more pool specific settings.
         *
         * @var	array
         **/
        'extras' => array()

    ];

}