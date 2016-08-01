<?php

namespace Tests\Gsup\ForumBundle;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * ApplicationAvailabilityFunctionalTest class.
 * @package Gsup\ForumBundle\Tests
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $fixtures = array(
            'Gsup\ForumBundle\DataFixtures\MongoDB\LoadCategoryData',
            'Gsup\ForumBundle\DataFixtures\MongoDB\LoadTagData',
            'Gsup\ForumBundle\DataFixtures\MongoDB\LoadUserData',
            'Tests\Gsup\ForumBundle\DataFixtures\MongoDB\LoadPostData',
        );

        (new self())->loadFixtures($fixtures, null, 'doctrine_mongodb');
    }

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/'),
            array('/create-post'),
            array('/post/test-post-for-tests'),
            array('/posts'),
//            array('/blog/category/fixture-category'),
//            array('/archives'),
        );
    }
} 