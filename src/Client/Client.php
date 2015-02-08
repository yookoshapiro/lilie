<?php namespace Lilie\Client;

use Lilie\Pool\Pool;
use Illuminate\Contracts\Foundation\Application as App;

class Client
{

    /**
     * Laravel's application
     *
     * @var     \Illuminate\Contracts\Foundation\Application
     */
    protected $app;


    /**
     * The database query (or table) for this client.
     *
     * @var     \Lilie\Eloquent\Client
     */
    protected $table;


    /**
     * The data for this class.
     *
     * @var     \Lilie\Client\Client
     */
    private $context;


    /**
     * Build a client object.
     *
     * @param   \Lilie\Eloquent\Client  $res
     */
    public function __construct($table, Pool $pool, App $app)
    {
        $this->app = $app;
        $this->table = $table;
        $this->context = $app->make(Data::class, [$table->toArray()]);

        $this->context['pool'] = $pool;
    }


    /**
     * Get the pool to this client.
     *
     * @return  \Lilie\Pool\Pool
     */
    public function getPool()
    {
        return $this->context->pool;
    }


    /**
     * Return the root page of this object.
     *
     * @return  \Lilie\Page\Page
     */
    public function getRoot()
    {
        return $this->table->pages()->find($this->context->root);
    }


}