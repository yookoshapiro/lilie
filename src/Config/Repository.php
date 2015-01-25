<?php namespace Lilie\Config;

use Illuminate\Config\Repository as ConfigRepository;

class Repository extends ConfigRepository
{
    /**
     * Create a new configuration repository.
     *
     * @param   \Lilie\Config\Loader    $loader
     */
    public function __construct(Loader $loader)
    {
        parent::__construct($loader->getData());
    }
}