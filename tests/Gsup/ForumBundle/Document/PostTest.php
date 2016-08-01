<?php

namespace Tests\Gsup\ForumBundle\Document;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\Tag;

/**
 * PostTest class.
 * @package Gsup\ForumBundle\Tests\Document
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class PostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Gsup\ForumBundle\Document\Post
     */
    private $_post;

    public function setUp()
    {
        parent::setUp();
        $this->_post = new Post();
    }

    public function testNormalize()
    {
        $tag = new Tag();
        $tag->setName('test tag');
        $tag->setSlug('test-tag');

        $this->_post->setTags([$tag]);
        $this->_post->normalizeTags();

        $this->assertEquals(['test-tag' => 'test tag'], $this->_post->getTags());
    }
} 