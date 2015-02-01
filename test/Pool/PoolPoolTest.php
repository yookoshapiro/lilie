<?php

use Lilie\Pool;

class PoolPoolTest extends PHPUnit_Framework_TestCase {

    public function getPool($data = array())
    {
        $repMock = Mockery::mock('\Lilie\Type\Repository');
        $appMock = Mockery::mock('\Illuminate\Contracts\Foundation\Application');
        $appMock->shouldReceive('make')->withAnyArgs()->andReturn($dataMock = Mockery::mock('\Lilie\Pool\Data'));

        return new Pool\Pool($data, $repMock, $appMock);
    }


    public function testGetDataFromContext()
    {
        $data = ['test' => 'Steven'];
        $pool = $this->getPool();

        $pool->getContext()->shouldReceive('offsetExists')->withAnyArgs()->andReturnUsing(function($value) use ($data)
        {
            return ! is_null(array_get($data, $value));
        });

        $pool->getContext()->shouldReceive('offsetGet')->withAnyArgs()->andReturnUsing(function($value) use ($data)
        {
            return array_get($data, $value);
        });

        $this->assertNull($pool->fail);
        $this->assertEquals('Steven', $pool->test);
    }


    public function testEquals()
    {
        $pool = $this->getPool();
        $failMock = $this->getPool();

        $this->assertTrue($pool->equals($pool));
        $this->assertFalse($pool->equals($failMock));
    }

}
