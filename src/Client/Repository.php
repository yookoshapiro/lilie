<?php namespace Lilie\Client;

use Illuminate\Support\Collection;
use Lilie\Eloquent\Client as Table;
use Lilie\Pool\Repository as PoolRepository;
use Illuminate\Contracts\Foundation\Application as App;

class Repository
{

    /**
     * Laravel's application
     *
     * @var	    \Illuminate\Contracts\Foundation\Application
     **/
    protected $app;


    /**
     * Laravel's application
     *
     * @var	    \Lilie\Eloquent\Client
     **/
    protected $table;


    /**
     * The loaded client objects.
     *
     * @var     \Illuminate\Support\Collection
     */
    protected $cache;


    /**
     * Lilie's pool repository.
     *
     * @var	    \Lilie\Pool\Repository
     **/
    protected $poolRepository;


    /**
     * Default client.
     *
     * @var     \Lilie\Client\Client
     */
    protected $default;


    /**
     * Build this Repository.
     *
     * @param   \Illuminate\Contracts\Foundation\Application    $app
     */
    public function __construct(App $app, Table $table, PoolRepository $poolRepository)
    {
        $this->app = $app;
        $this->table = $table;
        $this->cache = new Collection();
        $this->poolRepository = $poolRepository;
    }


    /**
     * Build a client object.
     *
     * @param   \Lilie\Eloquent\Client
     * @return  \Lilie\Client\Client
     */
    protected function mapObject(Table $table)
    {
        return $this->app->make(Client::class, [$table, $this->poolRepository->get($table->pool)]);
    }


    /**
     * Return a client object.
     *
     * @param   string  $name
     * @return  \Lilie\Client\Client
     */
    public function get($name)
    {
        if( $this->cache->has($name) )
        {
            return $this->cache->get($name);
        }

        $res = $this->table->where('name', '=', $name)->first();

        if( ! is_null($res))
        {
            $res = $this->mapObject($res);
        }

        $this->cache->put($name, $res);

        return $res;
    }


    /**
     * Check if the given client exists.
     *
     * @param   string  $name
     * @return  bool
     */
    public function exists($name)
    {
        return ! is_null($this->get($name));
    }


    /**
     * Return all existing clients.
     *
     * @return  \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return collect($this->table->get())
                ->map(function($item) {
                    return $this->mapObject($item);
                });
    }


    /**
     * Return the default client object.
     *
     * @return  \Lilie\Client\Client
     */
    public function getDefault()
    {
        return $this->default;
    }


    /**
     * Set the default client object.
     *
     * @param   \Lilie\Client\Client  $default
     * @return  void
     */
    public function setDefault(Client $default)
    {
        $this->default = $default;
    }

}