<?php namespace Lilie\Client;

use Lilie\Pool\Pool;
use Lilie\Page\Page;
use Lilie\Eloquent\Page as PageTable;
use Lilie\Eloquent\Client as ClientTable;
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
     * @var     \Lilie\Client\Data
     */
    private $context;


    /**
     * Build a client object.
     *
     * @param   \Lilie\Eloquent\Client  $res
     */
    public function __construct(ClientTable $table, Pool $pool, App $app)
    {
        $this->app = $app;
        $this->table = $table;
        $this->context = $app->make(Data::class, [$table->toArray()]);

        $this->context['pool'] = $pool;
    }


    /**
     * Return laravel's application.
     *
     * @return  \Illuminate\Contracts\Foundation\Application
     */
    public function getApp()
    {
        return $this->app;
    }


    /**
     * Return the context for this object.
     *
     * @return  \Lilie\DataObject
     */
    public function getContext()
    {
        return $this->context;
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
     * Build a page object.
     *
     * @param   \Lilie\Eloquent\Page
     * @return  \Lilie\Page\Page
     */
    protected function mapObject(PageTable $table)
    {
        $table->type = $this->getPool()->getType($table->type);

        return $this->app->make(Page::class, [$table]);
    }


    /**
     * Return the root page of this object.
     *
     * @return  \Lilie\Page\Page
     */
    public function getRoot()
    {
        return $this->mapObject( $this->table->pages()->find($this->context->root) );
    }


    /**
     * Return a page by the given id.
     *
     * @param   int     $id
     * @return  \Lilie\Page\Page
     */
    public function getPage($id)
    {
        return $this->table->pages()->find($id);
    }


}