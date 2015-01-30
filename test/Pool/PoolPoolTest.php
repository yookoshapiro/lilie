<?php

use Lilie\Pool;

class PoolPoolTest extends PHPUnit_Framework_TestCase {

    public function getPool($dataMock = null)
    {
        if(is_null($dataMock))
        {
            $dataMock = Mockery::mock(Pool\Data::class);
        }

        return new Pool\Pool($dataMock, Mockery::mock(\Lilie\Type\Repository::class));
    }


    public function testGetDataFromContext()
    {
        $pool = $this->getPool(new Pool\Data(['lib' => 'test']));

        $this->assertNull($pool->fail);
        $this->assertEquals('test', $pool->lib);
    }


    public function testEquals()
    {
        $pool = $this->getPool();

        $this->assertTrue($pool->equals($pool));
        $this->assertFalse($pool->equals(Mockery::mock(Pool\Pool::class)));
    }

}
