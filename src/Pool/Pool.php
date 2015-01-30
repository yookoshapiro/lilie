<?php namespace Lilie\Pool;

use Lilie\Type;
use Lilie\DataObject;

class Pool {

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
     * @param   \Lilie\DataObject       $context
     * @param   \Lilie\Type\Repository
     */
    public function __construct(DataObject $context, Type\Repository $repository)
    {
        $this->context = $context;
        $this->typeRepository = $repository;
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
     * Return a lilie type repository.
     *
     * @return  Type\Repository
     */
    public function getTypeRepository()
    {
        return $this->typeRepository;
    }


    /**
     * Return a page type search by the given name.
     *
     * @param   string  $name
     * @eturn   \Lilie\Type\Type
     */
    public function getType($name)
    {
        return $this->getTypeRespository()->get($name);
    }





    /**
     * Erstellt ein Object
     *
     * @param   string  $name
     * @param   mixed   $params
     * @return  mixed
     *
    protected function mapObject($name, $params)
    {
        if( isset($this->classes[$name]) )
        {
            return App::build( $this->classes[$name], $params );
        }

        return null;
    }


    /**
     * Erzeugt ein Objekt das zum Verarbeiten des übergebenen Pfades genutzt werden kann
     *
     * @param   string  $path
     * @return  \Lilie\Bundle\File
     *
    public function file($path)
    {
        return $this->mapObject('file', [$path, $this]);
    }


    /**
     *
     *
     *
    public function dir($path)
    {
        return $this->mapObject('dir', [$path, $this]);
    }*/

}