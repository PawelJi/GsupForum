<?php

namespace Gsup\ForumBundle\Tests\Traits;
use Gsup\ForumBundle\Tests\DummyDocument;

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
    private $document;

    public function setUp()
    {
        $this->document = new DummyDocument();
    }

    /**
     * @dataProvider propertyDataProvider
     */
    public function testSetFromArray($keyValueArray)
    {
        $this->setFromArray($keyValueArray);
        foreach (['name', 'address'] as $key) {
            $getter = 'get'.$key;
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
            [
                ['name' => 1, 'address' => ''],
            ],
            [
                ['name' => 'test'],
            ],
            [
                []
            ]
        ];
    }

} 