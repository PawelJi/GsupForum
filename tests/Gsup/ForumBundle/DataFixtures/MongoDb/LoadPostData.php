<?php

namespace Tests\Gsup\ForumBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gsup\ForumBundle\Document\Post;

/**
 * LoadPostData class.
 * @package Gsup\ForumBundle\Tests\DataFixtures\MongoDB
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setTitle('Test post for tests');
        $post->setContent('This is test post created for test purposes.');
        if ($this->hasReference('admin-user')) {
            $post->setUser($this->getReference('admin-user'));
        }
        if ($this->hasReference('random-category')) {
            $post->setCategory($this->getReference('random-category'));
        }
        $post->setTags(['test' => 'test']);
        $post->setIsActive(true);;

        $manager->persist($post);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
} 