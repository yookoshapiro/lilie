<?php namespace Lilie\Type;

use Config as AppConfig;
use Illuminate\Support\ServiceProvider;

class TypeServiceProvider extends ServiceProvider {


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(Repository::class, function($app)
        {
            return $app->build(Repository::class, [AppConfig::get('lilie.files')]);
        });

        $this->app->bind(Type::class, function($app, $args)
        {
            return $app->build(Type::class, $args);
        });

        $this->app->bind(Data::class, function($app, $args)
        {
            return $app->build(Data::class, $args);
        });

    }


}