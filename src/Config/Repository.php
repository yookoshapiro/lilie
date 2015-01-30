<?php namespace Lilie\Config;

use Illuminate\Config\Repository as ConfigRepository;

class Repository extends ConfigRepository
{
    /**
     * Create a new configuration repository.
     *
     * @param   string                  $path
     * @param   \Lilie\Config\Loader    $loader
     */
    public function __construct($path, Loader $loader)
    {
        $loader->loadConfig($path);

        parent::__construct($loader->getData());
    }
}