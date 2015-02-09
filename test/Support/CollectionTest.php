<?php


class TestableCollection extends Lilie\Support\Collection
{
    protected $data = ['test' => null, 'guarded' => null];
    protected $guarded = ['guarded'];
}

class CollectionTest extends \PHPUnit_Framework_TestCase {


    public function getCollection(array $data = array())
    {
        return new TestableCollection($data);
    }


    public function testIfConstructorOnlySetExistsValues()
    {
        $data = $this->getCollection(['test' => 1,'fail' => 2])->toArray();

        $this->assertEquals(1, $data['test']);
        $this->assertArrayNotHasKey('fail', $data);
    }


    /**
     * @expectedException ErrorException
     */
    public function testGetPropertyOnlyForExistsValue()
    {
        $object = $this->getCollection();

        $this->assertNull($object->test);
        $object->fail;
    }


    /**
     * @expectedException ErrorException
     */
    public function testGetArrayItemOnlyForExistsValue()
    {
        $object = $this->getCollection();

        $this->assertNull($object['test']);
        $object['fail'];
    }


    /**
     * @expectedException ErrorException
     */
    public function testSetValueOnlyForExistsValue()
    {
        $object = $this->getCollection();

        $object->test = 1;
        $this->assertEquals(1, $object->test);

        $object['test'] = 2;
        $this->assertEquals(2, $object['test']);

        $object['fail'] = 2;
        $object['fail'];
    }


    public function testCheckForValueExists()
    {
        $object = $this->getCollection();

        $this->assertTrue(isset($object->test));
        $this->assertFalse(isset($object->fail));
        $this->assertTrue(isset($object['test']));
        $this->assertFalse(isset($object['fail']));
    }


    public function testUnsetValue()
    {
        $object = $this->getCollection(['test' => 1]);

        unset( $object->test );
        $this->assertNull($object->test);

        $object->test = 2;
        unset( $object['test'] );
        $this->assertNull($object->test);
    }


    public function testIsReadable()
    {
        $collection = $this->getCollection();

        $this->assertTrue( $collection->isReadable('test') );
        $this->assertTrue( $collection->isReadable('guarded') );
    }


    public function testIsWriteable()
    {
        $collection = $this->getCollection();

        $this->assertTrue( $collection->isWriteable('test') );
        $this->assertFalse( $collection->isWriteable('guarded') );
    }


    public function testIsGuarded()
    {
        $collection = $this->getCollection();

        $this->assertFalse( $collection->isGuarded('test') );
        $this->assertTrue( $collection->isGuarded('guarded') );
    }

}
