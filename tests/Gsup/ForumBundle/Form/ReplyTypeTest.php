<?php

namespace Tests\Gsup\ForumBundle\Form;

use Gsup\ForumBundle\Document\Reply;
use Gsup\ForumBundle\Form\ReplyType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * ReplyTypeTest class.
 * @package Gsup\ForumBundle\Tests\Form
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class ReplyTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'content'   => 'test2',
        );

        $post = new Reply();

        $type = new ReplyType();
        $form = $this->factory->create($type, $post);
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