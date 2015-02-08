<?php


class TestableDataObject extends Lilie\DataObject
{
    protected $data = [
        'test' => null
    ];
}

class DataObjectTest extends \PHPUnit_Framework_TestCase {


    public function getDataObject(array $data = array())
    {
        return new TestableDataObject($data);
    }


    public function testIfConstructorOnlySetExistsValues()
    {
        $data = $this->getDataObject(['test' => 1,'fail' => 2])->toArray();

        $this->assertEquals(1, $data['test']);
        $this->assertArrayNotHasKey('fail', $data);
    }


    /**
     * @expectedException ErrorException
     */
    public function testGetPropertyOnlyForExistsValue()
    {
        $object = $this->getDataObject();

        $this->assertNull($object->test);
        $object->fail;
    }


    /**
     * @expectedException ErrorException
     */
    public function testGetArrayItemOnlyForExistsValue()
    {
        $object = $this->getDataObject();

        $this->assertNull($object['test']);
        $object['fail'];
    }


    /**
     * @expectedException ErrorException
     */
    public function testSetValueOnlyForExistsValue()
    {
        $object = $this->getDataObject();

        $object->test = 1;
        $this->assertEquals(1, $object->test);

        $object['test'] = 2;
        $this->assertEquals(2, $object['test']);

        $object['fail'] = 2;
        $object['fail'];
    }


    public function testCheckForValueExists()
    {
        $object = $this->getDataObject();

        $this->assertTrue(isset($object->test));
        $this->assertFalse(isset($object->fail));
        $this->assertTrue(isset($object['test']));
        $this->assertFalse(isset($object['fail']));
    }


    public function testUnsetValue()
    {
        $object = $this->getDataObject(['test' => 1]);

        unset( $object->test );
        $this->assertNull($object->test);

        $object->test = 2;
        unset( $object['test'] );
        $this->assertNull($object->test);
    }

}
