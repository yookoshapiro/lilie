<?php namespace Lilie\Type;

use Lilie\DataObject;

class Data extends DataObject {

    protected $data = [

        /**
         * Name of this page type.
         *
         * @var	string
         **/
        'name' => "",


        /**
         * Files to this page type.
         *
         * @var	array
         **/
        'files' => []

    ];

}