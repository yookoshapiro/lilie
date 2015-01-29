<?php

use Cache as AppCache;

class LoaderTest extends \PHPUnit_Framework_TestCase {

    public function getLoader()
    {
        return new Lilie\Config\Loader;
    }

    public function testGetData()
    {
        $loader = $this->getLoader();
        $data = $loader->getData();

        $this->assertArrayHasKey('default', $data);
        $this->assertEquals(4, count(head($data)));
    }
}
