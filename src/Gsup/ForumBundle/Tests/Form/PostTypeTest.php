<?php

namespace Gsup\ForumBundle\Tests\Form;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\Category;
use Gsup\ForumBundle\Form\PostType;
use Symfony\Component\Form\Test\TypeTestCase;

 /**
 * Post type test.
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
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