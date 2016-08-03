<?php
 
namespace Tests\Gsup\ForumBundle\Controller;

use Gsup\ForumBundle\Traits\TestUserTrait;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * PostControllerTest class.
 * @package Gsup\ForumBundle\Tests\Controller
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class PostControllerTest extends WebTestCase
{
    use TestUserTrait;

    public function setUp()
    {
        parent::setUp();

        $fixtures = array(
            'Gsup\ForumBundle\DataFixtures\MongoDB\LoadCategoryData',
            'Gsup\ForumBundle\DataFixtures\MongoDB\LoadTagData',
            'Gsup\ForumBundle\DataFixtures\MongoDB\LoadUserData',
            'Tests\Gsup\ForumBundle\DataFixtures\MongoDB\LoadPostData',
        );

        $this->loadFixtures($fixtures, null, 'doctrine_mongodb');
    }

    public function testCreatePostFormFields()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create-post');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertGreaterThan(0, $crawler->filter('form[name="post"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="post"] input[name="post[title]"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="post"] textarea[name="post[content]"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="post"] input[name="post[tags][]"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="post"] select[name="post[category]"]')->count());
    }

    public function testPostFormSubmitAnonymous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create-post');

        $categoryValue = $crawler
            ->filter('select[name="post[category]"] option')
            ->first()
            ->attr('value');

        $tagValue = $crawler
            ->filter('input[name="post[tags][]"]')
            ->first()
            ->attr('value');

        $buttonCrawlerNode = $crawler->selectButton('Create Post');

        $form = $buttonCrawlerNode->form();

        $client->submit($form, array(
            'post[title]' => 'Test post',
            'post[content]' => 'Test content',
            'post[category]' => $categoryValue,
            'post[tags]' => [$tagValue]
        ));

        $this->assertTrue($client->getResponse()->isRedirect());

        $this->assertTrue(
            $client->getResponse()->isRedirect('/login')
        );
    }

    public function testPostFormSubmitAuthenticated()
    {
        $client = $this->createAuthorizedClient();

        $crawler = $client->request('GET', '/create-post');

        $categoryValue = $crawler
            ->filter('select[name="post[category]"] option')
            ->first()
            ->attr('value');

        $tagValue = $crawler
            ->filter('input[name="post[tags][]"]')
            ->first()
            ->attr('value');

        $buttonCrawlerNode = $crawler->selectButton('Create Post');

        $form = $buttonCrawlerNode->form();

        $client->submit($form, array(
            'post[title]' => 'Test post',
            'post[content]' => 'Test content',
            'post[category]' => $categoryValue,
            'post[tags]' => [$tagValue]
        ));

        $this->assertTrue($client->getResponse()->isRedirect());

        $this->assertTrue(
            $client->getResponse()->isRedirect('/post/test-post')
        );
    }

    public function testReplyAnonymous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/post/test-post-for-tests');

        $buttonCrawlerNode = $crawler->selectButton('Reply');

        $form = $buttonCrawlerNode->form();

        $client->submit($form, array(
            'reply[content]' => 'Test content',
        ));

        $this->assertTrue($client->getResponse()->isRedirect());

        $this->assertTrue(
            $client->getResponse()->isRedirect('/login')
        );
    }

    public function testReplyAuthenticated()
    {
        $client = $this->createAuthorizedClient();

        $crawler = $client->request('GET', '/post/test-post-for-tests');

        $buttonCrawlerNode = $crawler->selectButton('Reply');

        $form = $buttonCrawlerNode->form();

        $client->submit($form, array(
            'reply[content]' => 'Test content',
        ));

        $this->assertTrue($client->getResponse()->isRedirect());

        $this->assertTrue(
            $client->getResponse()->isRedirect('/post/test-post-for-tests')
        );
    }

} 