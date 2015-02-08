<?php namespace Lilie\Page;

use Lilie\Eloquent\Page as PageTable;
use Illuminate\Contracts\Foundation\Application as App;

class Page {

    /**
     * Laravel's application
     *
     * @var     \Illuminate\Contracts\Foundation\Application
     */
    protected $app;


    /**
     * The database query (or table) for this page.
     *
     * @var     \Lilie\Eloquent\Client
     */
    protected $table;


    /**
     * The data for this class.
     *
     * @var     \Lilie\Client\Data
     */
    protected $context;


    /**
     * Build the page object.
     *
     * @param   \Lilie\Eloquent\Page    $context
     * @param   \Illuminate\Contracts\Foundation\Application    $table
     */
    function __construct(PageTable $table, App $app)
    {
        $this->app = $app;
        $this->table = $table;
        $this->context = $app->make(Data::class, [$table->toArray()]);
    }


}