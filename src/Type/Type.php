<?php namespace Lilie\Type;

use Illuminate\Contracts\Foundation\Application as App;

class Type {

    /**
     * Laravel's application
     *
     * @var	    \Illuminate\Contracts\Foundation\Application
     **/
    protected $app;


    /**
     * The data for this class.
     *
     * @var	    \Lilie\Type\Data
     **/
    private $context;


    /**
     * Build a type object.
     */
    public function __construct($name, $files, App $app)
    {
        $this->app = $app;

        $this->context = $app->make(Data::class, [[
            'name' => $name,
            'files' => $files
        ]]);
    }


    /**
     * Return the Laravel-App.
     *
     * @return  \Illuminate\Contracts\Foundation\Application
     */
    public function getApp()
    {
        return $this->app;
    }


    /**
     * Return the context for this object.
     *
     * @return  \Lilie\Type\Data
     */
    public function getContext()
    {
        return $this->context;
    }


    /**
     * Return the content from the context.
     *
     * @param	string	$key
     * @return	mixed
     **/
    public function __get($key)
    {
        return array_get( $this->context, $key );
    }

}