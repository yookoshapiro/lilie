<?php

class LoaderTest extends \PHPUnit_Framework_TestCase {

    public function getLoader()
    {
        return new Lilie\Config\Loader;
    }

    public function testGetData()
    {
        $loader = $this->getLoader();
        $loader->loadConfig( __DIR__ . '/asset' );

        $this->assertArrayHasKey('pool', $loader->getData());
    }
}
