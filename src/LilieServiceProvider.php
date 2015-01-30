<?php namespace Lilie;

use App;
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
        $this->app->singleton( Config\Repository::class, function()
        {
            return App::build(Config\Repository::class, [lilie_path(AppConfig::get('packages.lilie.puddle'))]);
        });


        /*
         |-----------------------------------------------------------------------------
         | Pool
         |-----------------------------------------------------------------------------
         */
        $this->app->singleton( Pool\Repository::class, function()
        {
            return App::build(Pool\Repository::class);
        });

        $this->app->bind( Pool\Pool::class, function()
        {
            return App::build(Pool\Pool::class);
        });

        $this->app->bind( Pool\Data::class, function()
        {
            return App::build(Pool\Data::class);
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