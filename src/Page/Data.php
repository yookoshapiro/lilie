<?php namespace Lilie\Page;

use Lilie\DataObject;

class Data extends DataObject {

    protected $data = [

        /**
         * Database id for this page.
         *
         * @var     int
         */
        'id' => null,


        /**
         * Database id for the client to this page.
         *
         * @var     int
         */
        'client_id' => null,


        /**
         * Parent page id.
         *
         * @var     int|null
         */
        'parent' => null,


        /**
         * Displayed name.
         *
         * @var     string
         */
        'name' => null,


        /**
         * Displayed title.
         *
         * @var     string
         */
        'title' => null,


        /**
         * Content for this page.
         *
         * @var     string
         */
        'content' => null,


        /**
         * Array with more information about this page.
         *
         * @var     array
         */
        'extra' => null,


        /**
         * Page type.
         *
         * @var     string
         */
        'type' => null,


        /**
         * Is this page active?
         *
         * @var     bool
         */
        'active' => null,


        /**
         * Is this page displayed in menus.
         *
         * @var     bool
         */
        'display' => null,


        /**
         * Date of creating.
         *
         * @var     string
         */
        'created_at' => null,


        /**
         * Date of last updating.
         *
         * @var     string
         */
        'updated_at' => null,


        /**
         * Date of soft deleting.
         *
         * @var     string
         */
        'deleted_at' => null

    ];

}