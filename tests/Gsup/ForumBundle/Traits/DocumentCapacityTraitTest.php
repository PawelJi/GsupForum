<?php

namespace Tests\Gsup\ForumBundle\Traits;

use Tests\Gsup\ForumBundle\DummyDocument;

/**
 * DocumentCapacityTraitTest class.
 * @package Gsup\ForumBundle\Tests\Traits
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class DocumentCapacityTraitTest extends \PHPUnit_Framework_TestCase
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
        $this->document->setFromArray($keyValueArray);
        foreach (['name', 'address'] as $key) {
            $getter = 'get'.$key;
            if (!isset($keyValueArray[$key])) {
                $this->assertEquals(null, $this->document->{$getter}());
            } else {
                $this->assertEquals($keyValueArray[$key], $this->document->{$getter}());
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
                ['name' => 'test']
            ],
            [
                []
            ]
        ];
    }

} 