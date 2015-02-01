<?php namespace Lilie\Pool;

use Lilie\DataObject;

class Data extends DataObject {

    protected $data = [

        /**
         * The class library in this pool.
         *
         * @var string
         **/
        'lib' => null,


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