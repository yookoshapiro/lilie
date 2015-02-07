<?php namespace Lilie;

use Lilie\Eloquent;
use File as AppFile;
use Config as AppConfig;
use Illuminate\Support\ServiceProvider;

class LilieServiceProvider extends ServiceProvider {


    /**
     *
     *
     * @return  void
     */
    public function boot()
    {

        //

    }


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
            AppConfig::get('lilie.path') . '/src/Support/helpers.php'
        ]);

        /*
         |-----------------------------------------------------------------------------
         | Config
         |-----------------------------------------------------------------------------
         */
        $this->app->singleton( Config\Repository::class, function($app)
        {
            return $app->build(Config\Repository::class, [lilie_path(AppConfig::get('lilie.puddle'))]);
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