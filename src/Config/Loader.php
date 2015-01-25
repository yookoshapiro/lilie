<?php namespace Lilie\Config;

use Cache as AppCache;
use Config as AppConfig;
use Illuminate\Support\Facades\File;

class Loader {

    /**
     * The config data as an array
     *
     * @var     array
     */
    private $data = array();


    /**
     * Constructor load the data from lilie's puddle
     */
    public function __construct()
    {
        $this->loadConfig( lilie_path(AppConfig::get('packages.lilie.puddle')) );
    }


    /**
     * Get back all loaded settings.
     *
     * @return  mixed
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * Load settings for lilie's puddle.
     *
     * @param   string  $path
     * @return  array
     */
    public function loadConfig($path)
    {
        if (AppCache::has($path) && ! AppConfig::get('app.debug'))
        {
            $this->data = $this->loadConfigFromCache($path);

            return;
        }

        $this->data = $this->loadConfigFromFiles($path);

        AppCache::forever($path, $this->data);
    }


    /**
     * Load settings from cache.
     *
     * @param   string  $key
     * @return  array
     */
    protected function loadConfigFromCache($key)
    {
        return AppCache::get($key);
    }


    /**
     * Get back all pool's setting as array.
     *
     * @param   string  $path
     * @return  array
     */
    protected function loadConfigFromFiles($path)
    {
        return array_reduce (File::directories($path), function($carry, $dir)
        {
            if (File::isFile($config = $dir . '/config.php'))
            {
                $carry[ File::name($dir) ] = File::getRequire($config);
            }

            return $carry;
        }, []);
    }
}