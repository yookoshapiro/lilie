<?php namespace Lilie\Type;

use Lilie\Pool;
use Lilie\Type;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Foundation\Application as App;

class Repository {

    /**
     * Laravel's application
     *
     * @var	    \Illuminate\Contracts\Foundation\Application
     **/
    protected $app;


    /**
     * Standard type files.
     *
     * @var	    array
     **/
    protected $files;


    /**
     * Lilie's pool repository.
     *
     * @var     \Lilie\Pool\Repository
     */
    protected $poolRepository;


    /**
     * Store all loaded type objects.
     *
     * @var     array
     */
    protected $cache = array();


    /**
     * Build the type repository.
     *
     * @param   array   $files
     * @param   \Illuminate\Contracts\Foundation\Application    $app
     * @param   \Lilie\Pool\Repository  $poolRepo
     */
    public function __construct(array $files, App $app, Pool\Repository $poolRepo)
    {
        $this->app = $app;
        $this->files = $files;
        $this->poolRepository = $poolRepo;
    }


    /**
     * Return laravel's application.
     *
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function getApp()
    {
        return $this->app;
    }


    /**
     * Return lilie's pool repository.
     *
     * @return \Lilie\Pool\Repository
     */
    public function getPoolRepository()
    {
        return $this->poolRepository;
    }


    /**
     * Return a page type object.
     *
     * @param   \Lilie\Pool\Pool    $pool
     * @param   string              $name
     * @return  \Lilie\Type\Type
     */
    public function get(Pool\Pool $pool, $name)
    {
        return $this->cache[ $name ] = $this->selectPool($pool, $name);
    }


    /**
     * Decide which pool get the type.
     *
     * @param   \Lilie\Pool\Pool    $pool
     * @param   string              $name
     * @return  \Lilie\Type\Type
     */
    public function selectPool(Pool\Pool $pool, $name)
    {
        if( $pool->hasType($name) )
        {
            return $this->mapObject($pool, $name);
        }

        // That is a bit magic. If the given pool not match, we try the default pool.
        $default = $this->getPoolRepository()->getDefault();

        if( $default->hasType($name) )
        {
            return $this->mapObject($default, $name);
        }

        return null;
    }


    /**
     * Build a type object.
     *
     * @param   \Lilie\Pool\Pool    $pool
     * @param   string  $name
     * @return  \Lilie\Type\Type
     */
    public function mapObject(Pool\Pool $pool, $name)
    {
        $files = $this->searchFiles( $pool->types .DIRECTORY_SEPARATOR. $name );
        $files['base'] = $pool->types .DIRECTORY_SEPARATOR. $name;

        return $this->app->make( Type\Type::class, [$name, $files] );
    }


    /**
     * Return a array with the real exists files in a type.
     *
     * @param   Pool\Pool   $pool
     * @param   string      $name
     * @return  array
     */
    public function searchFiles($path)
    {
        $fs = $this->app->make(Filesystem::class);

        return array_undot(
            array_filter(array_dot($this->files), function($item) use ($path, $fs)
            {
                return $fs->isFile( $path .DIRECTORY_SEPARATOR. $item );
            })
        );
    }

}