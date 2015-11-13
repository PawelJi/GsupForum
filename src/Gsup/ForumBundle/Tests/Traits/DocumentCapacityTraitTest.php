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