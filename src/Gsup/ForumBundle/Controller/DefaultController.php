<?php

namespace Gsup\ForumBundle\Controller;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\Category;
use Gsup\ForumBundle\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GsupForumBundle:Default:index.html.twig', array('name' => 'forum'));
    }

    public function queryAction()
    {
        $doctrine = $this->get('doctrine_mongodb');

        $category = $doctrine
            ->getRepository('GsupForumBundle:Category')
            ->find("55fc126e5f1add14660041a7");

        $user = $doctrine
            ->getRepository('GsupForumBundle:User')
            ->find("55fc143a5f1add056c0041a7");

        $post = new Post();
        $post->setTitle('test')
            ->setCategory($category)
            ->setUser($user)
            ->setContent('testowy post');

        $dm = $doctrine->getManager();
        $dm->persist($post);
        $dm->flush();

//        $category = new Category();
//        $category->setParentId(0);
//        $category->setName('Remonty');
//        $category->setSlug('remonty');
//        $category->setStringPath('Remonty');
//        $category->setNumericPath(1);
//        $category->setStatsTotalPosts(0);
//
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $dm->persist($category);
//        $dm->flush();
    }

}
