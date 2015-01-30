<?php

use Lilie\Pool;

class PoolRepositoryTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        Mockery::close();
    }


    public function getRepository()
    {
        $app = Mockery::mock('\Illuminate\Contracts\Foundation\Application');
        $config = Mockery::mock('\Lilie\Config\Repository');

        return new Pool\Repository($app, $config);
    }


    public function testGetPoolObject()
    {
        $poolName = 'test';
        $object = $this->getRepository();
        $poolMock = Mockery::mock(Pool\Pool::class);
        $dataMock = Mockery::mock(Pool\Data::class);

        $object->getConfig()->shouldReceive('has')->with($poolName)->AndReturn(true);
        $object->getConfig()->shouldReceive('has')->with('unknown')->AndReturn(false);
        $object->getConfig()->shouldReceive('get')->with($poolName)->andReturn([]);
        $object->getApp()->shouldReceive('make')->withArgs([Pool\Data::class, [[]]])->AndReturn($dataMock);
        $object->getApp()->shouldReceive('make')->withArgs([Pool\Pool::class, [$dataMock]])->andReturn($poolMock);

        $this->assertNull($object->get('unknown'));
        $this->assertInstanceOf(get_class($poolMock), $object->get($poolName));
    }


    public function testExists()
    {
        $poolName = 'test';
        $object = $this->getRepository();
        $poolMock = Mockery::mock(Pool\Pool::class);
        $dataMock = Mockery::mock(Pool\Data::class);

        $object->getConfig()->shouldReceive('has')->with($poolName)->AndReturn(true);
        $object->getConfig()->shouldReceive('has')->with('unknown')->AndReturn(false);
        $object->getConfig()->shouldReceive('get')->with($poolName)->andReturn([]);
        $object->getApp()->shouldReceive('make')->withArgs([Pool\Data::class, [[]]])->AndReturn($dataMock);
        $object->getApp()->shouldReceive('make')->withArgs([Pool\Pool::class, [$dataMock]])->andReturn($poolMock);

        $this->assertTrue($object->exists($poolName));
        $this->assertFalse($object->exists('unknown'));
    }

}
