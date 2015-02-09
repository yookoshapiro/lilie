<?php namespace Lilie\Support;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;

class Collection implements ArrayAccess, Arrayable {

    /**
     * Store the data for this Object, must be filled by child class.
     *
     * @var     array
     */
    protected $data = [];


    /**
     * The attributes that can't be changed.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Constructor allows setup the object with values.
     *
     * @param    array $data
     */
    public function __construct(array $data = array())
    {
        foreach ($data as $key => $item) {
            if ($this->isReadable($key)) {
                $this->offsetSet($key, $item);
            }
        }
    }


    /**
     * Return if the given data field is guarded.
     *
     * @param   string $name
     * @return  bool
     */
    public function isGuarded($name)
    {
        return array_search($name, $this->guarded) !== false;
    }


    /**
     * Return if a given data field is readable.
     *
     * @param   string $name
     * @return  bool
     */
    public function isReadable($name)
    {
        return array_key_exists($name, $this->data);
    }


    /**
     * Return if a given data field is writable.
     *
     * @param   string $name
     * @return  bool
     */
    public function isWriteable($name)
    {
        return $this->isReadable($name) && !$this->isGuarded($name);
    }


    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function($value)
        {
            return $value instanceof Arrayable ? $value->toArray() : $value;

        }, $this->data);
    }


    /**
     * Returns the value for the given key, if the key exists in the data storage.
     *
     * @param   string $key
     * @return  mixed
     * @throws  ErrorException
     */
    public function __get($key)
    {
        if ($this->isReadable($key)) {
            return $this->offsetGet($key);
        }

        throw new \ErrorException('unknown property ' . get_class($this) . '::$' . $key);
    }


    /**
     * Returns the value at the specified index.
     *
     * @param    mixed $offset
     * @return    mixed|null
     * @throw   ErrorException
     */
    public function offsetGet($offset)
    {
        if ($this->isReadable($offset)) {
            return array_get($this->data, $offset);
        }

        throw new \ErrorException('Undefined index: ' . $offset);
    }


    /**
     * Set value by a given key, if the key exists.
     *
     * @param    string $key
     * @param    string $value
     * @return    void
     **/
    public function __set($key, $value)
    {
        if ($this->isWriteable($key)) {
            $this->offsetSet($key, $value);
        }
    }


    /**
     * Sets the value at the specified index to newval.
     *
     * @param    string $offset
     * @param    mixed  $value
     */
    public function offsetSet($offset, $value)
    {
        if ($this->isWriteable($offset)) {
            array_set($this->data, $offset, $value);
        }
    }


    /**
     * Returns, if the given key exists.
     *
     * @param   string $offset
     * @return  bool
     */
    public function __isset($key)
    {
        return $this->isReadable($key);
    }


    /**
     * Returns whether the requested index exists.
     *
     * @param    mixed $offset
     * @return    bool
     */
    public function offsetExists($offset)
    {
        return $this->isReadable($offset);
    }


    /**
     * Reset the value found by the given key back to null.
     *
     * @param   string $key
     * @return  bool
     */
    public function __unset($key)
    {
        if ($this->isWriteable($key)) {
            $this->offsetSet($key, null);
        }
    }


    /**
     * Unsets the value at the specified index.
     *
     * @param    mixed $offset
     */
    public function offsetUnset($offset)
    {
        if ($this->isWriteable($offset)) {
            $this->offsetSet($offset, null);
        }
    }

}