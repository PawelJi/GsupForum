<?php

namespace Gsup\ForumBundle\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

 /**
 * ApplicationAvailabilityFunctionalTest test class.
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
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
            'Gsup\ForumBundle\Tests\DataFixtures\MongoDB\LoadPostData',
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