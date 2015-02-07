<?php namespace Lilie\Pool;

use Illuminate\Support\ServiceProvider;

class PoolServiceProvider extends ServiceProvider {


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(Repository::class, function($app)
        {
            return $app->build(Repository::class);
        });

        $this->app->bind(Pool::class, function($app, $args)
        {
            return $app->build(Pool::class, $args);
        });

        $this->app->bind(Data::class, function($app, $args)
        {
            return $app->build(Data::class, $args);
        });

    }

}