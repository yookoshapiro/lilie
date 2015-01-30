<?php namespace Lilie\Pool;

use Lilie\Pool\Pool as PoolObject;
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
     * Einstellungen aller Pools
     *
     * @var	    \Lilie\Config\Repository
     **/
    protected $config;


    /**
     * Erzeugte Objekte die ein Pool darstellen
     *
     * @var	    array
     **/
    protected $pools = array();


    /**
     * Das Bundle, das als Grundlage für alle anderen dient
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
     * Erstellt ein Object
     *
     * @param   string  $name
     * @param   mixed   $params
     * @return  object
     */
    protected function mapObject($name)
    {
        return $this->app->make(PoolObject::class, [
            $this->app->make(Data::class, [$this->config->get($name)])
        ]);
    }


    /**
     * Gibt eine Bundle-Klasse wieder
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
     * Setzen des default-Bundles
     *
     * @param   \Lilie\Pool\Pool   $default
     * @return  void
     */
    public function setDefault(PoolObject $default)
    {
        $this->default = $default;
    }


    /**
     * Gibt das default-Bundle zurück
     *
     * @return  \Lilie\Pool\Pool
     */
    public function getDefault()
    {
        return $this->default;
    }


    /**
     * Gibt zurück, ob ein Bundle mit dem übergebenen Namen exisitiert
     *
     * @param	string	$name
     * @return	bool
     */
    public function exists($name)
    {
        return ! is_null( $this->get($name) );
    }

}