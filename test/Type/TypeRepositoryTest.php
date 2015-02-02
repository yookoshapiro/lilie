<?php

class TypeRepositoryTest extends PHPUnit_Framework_TestCase {

    public function getRepo(array $files = array())
    {
        $appMock = Mockery::mock('\Illuminate\Contracts\Foundation\Application');
        $poolMock = Mockery::mock('\Lilie\Pool\Repository');

        return new \Lilie\Type\Repository($files, $appMock, $poolMock);
    }


    public function testSearchFiles()
    {
        $repo = $this->getRepo(['index' => ['path/to/hell'], 'fail' => ['path/to/nothing']]);

        $fsMock = Mockery::mock('Illuminate\Filesystem\Filesystem');
        $repo->getApp()->shouldReceive('make')->withAnyArgs()->andReturn($fsMock);
        $fsMock->shouldReceive('isFile')->withAnyArgs()->andReturn(true)->once();
        $fsMock->shouldReceive('isFile')->withAnyArgs()->andReturn(false)->once();

        $this->assertEquals(['index' => ['path/to/hell']], $repo->searchFiles(''));
    }

}
