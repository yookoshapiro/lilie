<?php namespace Lilie\Config;

use Illuminate\Config\Repository as ConfigRepository;

class Repository extends ConfigRepository
{
    /**
     * Create a new configuration repository.
     *
     * @param   \Lilie\Config\Loader    $loader
     * @param   string                  $path
     */
    public function __construct(Loader $loader, $path)
    {
        $loader->loadConfig($path);

        parent::__construct($loader->getData());
    }
}