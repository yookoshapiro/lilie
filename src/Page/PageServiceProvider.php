<?php namespace Lilie\Page;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(Page::class, function($app, $args)
        {
            return $app->build(Page::class, $args);
        });

        $this->app->bind(Data::class, function($app, $args)
        {
            return $app->build(Data::class, $args);
        });

    }

}