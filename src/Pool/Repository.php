<?php namespace Lilie\Pool;

use Config as AppConfig;
use Lilie\Pool\Pool as PoolObject;
use Illuminate\Support\Facades\File;
use Lilie\Config\Repository as Config;
use Illuminate\Contracts\Foundation\Application as App;

class Repository {

    /**
     * Laravel's application
     *
     * @var	    \Illuminate\Contracts\Foundation\Application
     **/
    protected $app;


    /**
     * Configuration of all pools.
     *
     * @var	    \Lilie\Config\Repository
     **/
    protected $config;


    /**
     * Cache for builded pool objects.
     *
     * @var	    array
     **/
    protected $pools = array();


    /**
     * The default pool.
     *
     * @var	    \Lilie\Pool\Bundle
     **/
    protected $default;


    /**
     * Create a new pool repository with laravel's app and lilie's configuration
     *
     * @param   \Illuminate\Contracts\Foundation\Application    $app
     * @param   \Lilie\Config\Repository                        $config
     */
    public function __construct(App $app, Config $config)
    {
        $this->app = $app;
        $this->config = $config;
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
     * Returns lilie's pool configuration.
     *
     * @return  \Lilie\Config\Repository
     */
    public function getConfig()
    {
        return $this->config;
    }


    /**
     * Build a new pool object.
     *
     * @param   string  $name
     * @param   mixed   $params
     * @return  object
     */
    protected function mapObject($name)
    {
        $puddle = AppConfig::get('packages.lilie.puddle');

        $data = array_map(function($item) use ($puddle, $name)
        {
            if(is_array($item))
            {
                return $item;
            }

            $path = lilie_path(
                implode(DIRECTORY_SEPARATOR, [$puddle, $name, $item])
            );

            return File::isDirectory($path) ? $path : $item;
        }, $this->config->get($name));

        return $this->app->make(PoolObject::class, [$data]);
    }


    /**
     * Return a pool-object.
     *
     * @param	string	$name
     * @return	\Lilie\Pool\Pool|null
     **/
    public function get($name)
    {
        if(array_key_exists($name, $this->pools))
        {
            return $this->pools[$name];
        }

        if( ! $this->config->has($name))
        {
            return null;
        }

        return $this->pools[$name] = $this->mapObject($name);
    }


    /**
     * Set the default pool.
     *
     * @param   \Lilie\Pool\Pool   $default
     * @return  void
     */
    public function setDefault(PoolObject $default)
    {
        $this->default = $default;
    }


    /**
     * Return the default pool.
     *
     * @return  \Lilie\Pool\Pool
     */
    public function getDefault()
    {
        return $this->default;
    }


    /**
     * Check if the given pool name exists.
     *
     * @param	string	$name
     * @return	bool
     */
    public function exists($name)
    {
        return ! is_null( $this->get($name) );
    }

}