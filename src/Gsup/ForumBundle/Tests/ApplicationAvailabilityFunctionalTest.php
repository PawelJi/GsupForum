<?php

namespace Gsup\ForumBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
//            array('/post/fixture-post-1'),
//            array('/blog/category/fixture-category'),
//            array('/archives'),
        );
    }
} 