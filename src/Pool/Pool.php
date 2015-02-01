<?php namespace Lilie\Pool;

use Lilie\Type;
use Illuminate\Contracts\Foundation\Application as App;

class Pool {

    /**
     * Laravel's application
     *
     * @var	    \Illuminate\Contracts\Foundation\Application
     **/
    protected $app;


    /**
     * The data for this class.
     *
     * @var	    \Lilie\DataObject
     **/
    private $context;


    /**
     * a lilie type repository
     *
     * @var	    \Lilie\Type\Repository
     **/
    private $typeRepository;


    /**
     * Build the object.
     *
     * @param   array   $context
     * @param   \Lilie\Type\Repository  $repository
     * @param   \Illuminate\Contracts\Foundation\Application    $app
     */
    public function __construct($context, Type\Repository $repository, App $app)
    {
        $this->app = $app;
        $this->context = $app->make(Data::class, [$context]);
        $this->typeRepository = $repository;
    }


    /**
     * Returns the Laravel-App.
     *
     * @return  \Illuminate\Contracts\Foundation\Application
     */
    public function getApp()
    {
        return $this->app;
    }


    /**
     * Return the data object for this object
     *
     * @return  \Lilie\Pool\Data;
     */
    public function getContext()
    {
        return $this->context;
    }


    /**
     * Return a lilie type repository.
     *
     * @return  \Lilie\Type\Repository
     */
    public function getTypeRepository()
    {
        return $this->typeRepository;
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


    /**
     * Check if the given pool is the same as this.
     *
     * @param   \Lilie\Pool\Pool    $pool
     * @return  bool
     */
    public function equals(Pool $pool)
    {
        return spl_object_hash($pool) === spl_object_hash($this);
    }


    /**
     * Return a page type search by the given name.
     *
     * @param   string  $name
     * @eturn   \Lilie\Type\Type
     */
    public function getType($name)
    {
        return $this->getTypeRespository()->get($this, $name);
    }

}