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
        $this->loadFile([
            AppConfig::get('packages.lilie.path', app_path()) . '/src/Support/helpers.php'
        ]);

        $this->app->singleton( Config\Repository::class, function()
        {
            return new Config\Repository( new Config\Loader() );
        });

        $this->app->singleton( Pool\Repository::class, function()
        {
            return new Pool\Repository;
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