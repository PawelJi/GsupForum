<?php

namespace Gsup\ForumBundle\Tests\Form;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Form\ReplyType;
use Symfony\Component\Form\Test\TypeTestCase;

 /**
 * ReplyTypeTest test class.
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class ReplyTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'content'   => 'test2',
        );

        $post = new Post();

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