<?php
 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
 
namespace Gsup\ForumBundle\Tests\Controller;

use Gsup\ForumBundle\Traits\TestUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    use TestUser;

    public function testCreatePostFormFields()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create-post');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertGreaterThan(0, $crawler->filter('form[name="forum_post"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="forum_post"] input[name="forum_post[title]"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="forum_post"] textarea[name="forum_post[content]"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="forum_post"] input[name="forum_post[tags][]"]')->count());
        $this->assertGreaterThan(0, $crawler->filter('form[name="forum_post"] select[name="forum_post[category]"]')->count());
    }

    public function testPostFormSubmitAnonymous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create-post');

        $categoryValue = $crawler
            ->filter('select[name="forum_post[category]"] option')
            ->first()
            ->attr('value');

        $tagValue = $crawler
            ->filter('input[name="forum_post[tags][]"]')
            ->first()
            ->attr('value');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form();

        $client->submit($form, array(
            'forum_post[title]' => 'Test post',
            'forum_post[content]' => 'Test content',
            'forum_post[category]' => $categoryValue,
            'forum_post[tags]' => [$tagValue]
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
            ->filter('select[name="forum_post[category]"] option')
            ->first()
            ->attr('value');

        $tagValue = $crawler
            ->filter('input[name="forum_post[tags][]"]')
            ->first()
            ->attr('value');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form();

        $client->submit($form, array(
            'forum_post[title]' => 'Test post',
            'forum_post[content]' => 'Test content',
            'forum_post[category]' => $categoryValue,
            'forum_post[tags]' => [$tagValue]
        ));

        $this->assertTrue($client->getResponse()->isRedirect());

        $this->assertFalse(
            $client->getResponse()->isRedirect('/login')
        );
    }

    public function testPostView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/post/test');
    }

} 