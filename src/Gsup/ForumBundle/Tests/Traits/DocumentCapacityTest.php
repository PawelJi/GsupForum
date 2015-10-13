<?php

namespace Gsup\ForumBundle\Tests\Traits;
use Gsup\ForumBundle\Traits\DocumentCapacity;

/**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class DocumentCapacityTest extends \PHPUnit_Framework_TestCase
{
    use DocumentCapacity;

    /**
     * @var mixed
     */
    private $_testPropertyOne;

    /**
     * @var mixed
     */
    private $_testPropertyTwo;

    public function setUp()
    {
        $this->_testPropertyOne = null;
        $this->_testPropertyTwo = null;
    }

    /**
     * @dataProvider propertyDataProvider
     */
    public function testSetFromArray($keyValueArray)
    {
        $this->setFromArray($keyValueArray);
        foreach (['testPropertyOne', 'testPropertyTwo'] as $key) {
            $getter = 'get'.ucfirst($key);
            if (!isset($keyValueArray[$key])) {
                $this->assertEquals(null, $this->{$getter}());
            } else {
                $this->assertEquals($keyValueArray[$key], $this->{$getter}());
            }
        }
    }

    public function propertyDataProvider()
    {
        return [
            ['testPropertyOne' => 1, 'testPropertyTwo' => 2],
            ['testPropertyOne' => 'test'],
            []
        ];
    }

    /**
     * @param mixed $testPropertyOne
     */
    public function setTestPropertyOne($testPropertyOne)
    {
        $this->_testPropertyOne = $testPropertyOne;
    }

    /**
     * @return mixed
     */
    public function getTestPropertyOne()
    {
        return $this->_testPropertyOne;
    }

    /**
     * @param mixed $testPropertyTwo
     */
    public function setTestPropertyTwo($testPropertyTwo)
    {
        $this->_testPropertyTwo = $testPropertyTwo;
    }

    /**
     * @return mixed
     */
    public function getTestPropertyTwo()
    {
        return $this->_testPropertyTwo;
    }

} 