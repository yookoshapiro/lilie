<?php namespace Lilie;

use ErrorException;

abstract class DataObject implements \ArrayAccess {

    /**
     * Store the data for this Object, must be filled by child class.
     *
     * @var     array
     */
    protected $data = [];


    /**
     * Constructor allows setup the object with values.
     *
     * @param    array 		$data
     */
    final public function __construct(array $data = array())
    {
        foreach($data as $key => $item)
        {
            if( array_key_exists($key, $this->data) )
            {
                $this->data[$key] = $item;
            }
        }
    }


    /**
     * Returns all data of this object.
     *
     * @return  array
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * Returns the value for the given key, if the key exists in the data storage.
     *
     * @param   string  $key
     * @return  mixed
     * @throws  ErrorException
     */
    public function __get($key)
    {
        if( array_key_exists($key, $this->data) )
        {
            return $this->data[$key];
        }

        throw new ErrorException('unknown property '. get_class($this) .'::$'. $key);
    }


    /**
     * Returns the value at the specified index.
     *
     * @param	mixed		$offset
     * @return	mixed|null
     * @throw   ErrorException
     */
    public function offsetGet($offset)
    {
        if( array_key_exists($offset, $this->data) )
        {
            return $this->data[$offset];
        }

        throw new \ErrorException('Undefined index: ' . $offset);
    }


    /**
     * Set value by a given key, if the key exists.
     *
     * @param	string		$key
     * @param	string		$value
     * @return	void
     **/
    public function __set($key, $value)
    {
        if( array_key_exists($key, $this->data) )
        {
            $this->data[$key] = $value;
        }
    }


    /**
     * Sets the value at the specified index to newval.
     *
     * @param    string		$offset
     * @param    mixed		$value
     */
    public function offsetSet($offset, $value)
    {
        if( array_key_exists($offset, $this->data) )
        {
            $this->data[$offset] = $value;
        }
    }


    /**
     * Returns, if the given key exists.
     *
     * @param   string  $offset
     * @return  bool
     */
    public function __isset($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Returns whether the requested index exists.
     *
     * @param	mixed		$offset
     * @return	bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }


    /**
     * Reset the value found by the given key back to null.
     *
     * @param   string  $key
     * @return  bool
     */
    public function __unset($key)
    {
        if( array_key_exists($key, $this->data) )
        {
            $this->data[$key] = null;
        }
    }


    /**
     * Unsets the value at the specified index.
     *
     * @param	mixed		$offset
     */
    public function offsetUnset($offset)
    {
        if( array_key_exists($offset, $this->data) )
        {
            $this->data[$offset] = null;
        }
    }

}