<?php namespace Lilie\Pool;

use Lilie\Type;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Foundation\Application as App;

class Pool implements Arrayable {

    /**
     * Laravel's application
     *
     * @var	    \Illuminate\Contracts\Foundation\Application
     **/
    protected $app;


    /**
     * The data for this class.
     *
     * @var	    \Lilie\Pool\Data
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
        $this->typeRepository = $repository;
        $this->context = $app->make(Data::class, [$context]);
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
        return $this->getTypeRepository()->get($this, $name);
    }


    /**
     * Check if the given name exists as dir in the type folder of this pool.
     *
     * @param   string  $name
     * @return  bool
     */
    public function hasType($name)
    {
        return File::isDirectory( $this->context->types .DIRECTORY_SEPARATOR. $name );
    }


    /**
     * Get the context as a plain array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->context->toArray();
    }

}