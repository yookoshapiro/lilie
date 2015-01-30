<?php namespace Lilie\Pool;

use Lilie\DataObject;

class Data extends DataObject {

    protected $data = [

        /**
         * Name des Ordners im Paket indem weitere Klasse liegen
         *
         * @var string
         **/
        'lib' => null,

        /**
         * Name des Ordners im Paket indem die Seitentypen liegen
         *
         * @var	string
         **/
        'types' => null,

        /**
         * Dateien die beim initieren des Pakets geladen werden
         *
         * @var	array
         **/
        'files' => array(),

        /**
         * Erlaubt ein Paket das auf keinen der definierten Pakete beruht (optional)
         *
         * @var	array
         **/
        'client' => array()

    ];

}