<?php namespace Lilie\Type;

use Lilie\Support\Collection;

class Data extends Collection {

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