<?php namespace Lilie\Client;

use Closure;
use Lilie\Pool\Pool;
use Lilie\Page\Page;
use Illuminate\Support\Collection;
use Lilie\Eloquent\Page as EloquentPage;
use Lilie\Eloquent\Client as EloquentClient;
use Illuminate\Contracts\Foundation\Application as App;

class Client {

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
     * Cache for page objects.
     *
     * @var     \Illuminate\Support\Collection
     */
    private $cache;


    /**
     * Build a client object.
     *
     * @param   \Lilie\Eloquent\Client  $res
     */
    public function __construct(EloquentClient $table, Pool $pool, App $app)
    {
        $this->app = $app;
        $this->table = $table;
        $this->cache = new Collection;
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
    protected function mapObject(EloquentPage $table)
    {
        if ($this->cache->has($table->id)) {
            return $this->cache->get($table->id);
        }

        $data = $table->toArray();
        $data['type'] = $this->getPool()->getType($table->type);

        $res = $this->app->make(Page::class, [
            $data, $this->table->pages()->getQuery()
        ]);

        $this->cache->put($table->id, $res);

        return $res;
    }


    /**
     * Return a collection with all pages assign to this client.
     *
     * @param   \Closure     $callback
     * @return  \Illuminate\Support\Collection
     */
    public function getPages(Closure $callback = null)
    {
        $res = $this->table->pages()->getQuery();

        if ( ! is_null($callback)) {
            $callback($res);
        }

        return $res->get()->transform(function($item) {
            return $this->mapObject($item);
        });
    }


    /**
     * Return a page by the given id.
     *
     * @param   int     $id
     * @return  \Lilie\Page\Page
     */
    public function getPage($id)
    {
        return $this->getPages(function($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }


    /**
     * Return the root page of this object.
     *
     * @return  \Lilie\Page\Page
     */
    public function getRoot()
    {
        return $this->getPage($this->context->root);
    }


}