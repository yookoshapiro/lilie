<?php namespace Lilie\Client;

use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{

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

        $this->app->bind(Client::class, function($app, $args)
        {
            return $app->build(Client::class, $args);
        });

        $this->app->bind(Data::class, function($app, $args)
        {
            return $app->build(Data::class, $args);
        });

    }

}