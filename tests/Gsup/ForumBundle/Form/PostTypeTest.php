<?php

namespace Tests\Gsup\ForumBundle\Form;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\Category;
use Gsup\ForumBundle\Form\PostType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * PostTypeTest class.
 * @package Gsup\ForumBundle\Tests\Form
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class PostTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $post = new Post();

        $category = new Category();

        $formData = array(
            'title'     => 'test',
            'content'   => 'test2',
            'category'  => $category,
            'tags'      => ['common' => 'abc']
        );

        $type = new PostType();
        $form = $this->factory->create($type, $post, ['env' => 'test']);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($post, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
} 