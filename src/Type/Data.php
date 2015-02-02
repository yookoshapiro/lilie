<?php namespace Lilie\Type;

use Lilie\DataObject;

class Data extends DataObject {

    protected $data = [

        /**
         * Der Name dieses Seitentypes
         *
         * @var	string
         **/
        'name' => "",


        /**
         * Die Dateien zu diesem Seitentyp
         *
         * @var	array
         **/
        'files' => []

    ];

}