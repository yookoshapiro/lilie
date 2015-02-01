<?php namespace Lilie;

use File as AppFile;
use Config as AppConfig;
use Illuminate\Support\ServiceProvider;

class LilieServiceProvider extends ServiceProvider {

    /*
     * Register all the Repository used by Lilie.
     *
     * @return void
     */
    public function register()
    {
        /*
         |-----------------------------------------------------------------------------
         | Lilie' startup
         |-----------------------------------------------------------------------------
         */
        $this->loadFile([
            AppConfig::get('packages.lilie.path', app_path()) . '/src/Support/helpers.php'
        ]);


        /*
         |-----------------------------------------------------------------------------
         | Config
         |-----------------------------------------------------------------------------
         */
        $this->app->singleton( Config\Repository::class, function($app)
        {
            return $app->build(Config\Repository::class, [lilie_path(AppConfig::get('packages.lilie.puddle'))]);
        });


        /*
         |-----------------------------------------------------------------------------
         | Pool
         |-----------------------------------------------------------------------------
         */
        $this->app->singleton( Pool\Repository::class, function($app)
        {
            return $app->build(Pool\Repository::class);
        });

        $this->app->bind( Pool\Pool::class, function($app, $args)
        {
            return $app->build(Pool\Pool::class, $args);
        });

        $this->app->bind( Pool\Data::class, function($app, $args)
        {
            return $app->build(Pool\Data::class, $args);
        });


        /*
         |-----------------------------------------------------------------------------
         | Type
         |-----------------------------------------------------------------------------
         */
        $this->app->singleton( Type\Repository::class, function($app)
        {
            return $app->build(Type\Repository::class);
        });
    }


    /**
     * Load all require files
     *
     * @param   array   $paths
     * @return  void
     */
    public function loadFile(array $paths)
    {
        foreach($paths as $path)
        {
            AppFile::requireOnce( $path );
        }
    }

}