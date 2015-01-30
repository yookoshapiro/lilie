<?php

class RepositoryTest extends PHPUnit_Framework_TestCase {

    public function getRepository()
    {
        $path = __DIR__ . '/asset';
        $loaderMock = Mockery::mock('Lilie\Config\Loader');

        $loaderMock->shouldReceive('loadConfig')
            ->with($path)
            ->andReturnNull();

        $loaderMock->shouldReceive('getData')
            ->andReturn([
                'pool' => ['path' => 'to/hell']
            ]);

        return new Lilie\Config\Repository( $path, $loaderMock);
    }

    public function testThatConfigArrivedRepository()
    {
        $object = $this->getRepository();

        $this->assertEquals('to/hell', $object->get('pool.path'));
    }

}
