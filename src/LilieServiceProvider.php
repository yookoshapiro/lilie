<?php namespace Lilie;

use Illuminate\Support\ServiceProvider;

class LilieServiceProvider extends ServiceProvider {

    /*
     * Register all the Repository used by Lilie.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton( Pool\Repository::class ,function()
        {
            return new Pool\Repository();
        });

    }

}