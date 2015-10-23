<?php

namespace Gsup\ForumBundle\Controller;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Form\PostType;
use Gsup\ForumBundle\Form\ReplyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PostController
 * @package Gsup\ForumBundle\Controller
 */
class PostController extends Controller
{
    public function createAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(new PostType(), $post, array(
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->render('GsupForumBundle:Post:create.html.twig',array(
                    'title' => 'Create new post',
                    'form' => $form->createView()
                )
            );
        }

        $post->normalizeTags();

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $post->setUser($this->getUser());
            $post->setIsActive(true);
        }

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($post);
        $dm->flush();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->get('session')->getFlashBag()->add('notice', 'Login of register to add new post.');
            $this->get('session')->set('postAdd', $post->getId());
            return $this->redirectToRoute('fos_user_security_login');
        }

        $this->get('session')->getFlashBag()->add('success', 'You have successfully added new post.');

        return $this->redirectToRoute('gsup_post_show', array(
            'slug' => $post->getSlug()
        ));
    }

    public function showAction($slug)
    {
        $post = $this->get('doctrine_mongodb')
            ->getRepository('GsupForumBundle:Post')
            ->findActiveBySlug($slug);

        if (!$post) {
            throw $this->createNotFoundException('The post does not exist.');
        }

        return $this->render('GsupForumBundle:Post:show.html.twig',array(
                'title' => 'Post - '. $post->getTitle(),
                'post' => $post,
                'form' => $this->createForm(new ReplyType(), null, array(
                        'method' => 'POST'
                    ))->createView()
            )
        );
    }

    public function replyFormAction(Request $request, $slug)
    {
        $post = $this->get('doctrine_mongodb')
            ->getRepository('GsupForumBundle:Post')
            ->findActiveBySlug($slug);

        if (!$post) {
            throw $this->createNotFoundException('The post does not exist.');
        }

        $reply = new Post();

        $form = $this->createForm(new ReplyType(), $reply, array(
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if( !$form->isValid() ){
            return $this->render('GsupForumBundle:Post:show.html.twig',array(
                    'title' => 'Post - '. $post->getTitle(),
                    'post' => $post,
                    'form' => $form->createView()
                )
            );
        }

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $reply->setUser($this->getUser());
            $reply->setIsActive(true);
        }

        $reply->setIsAnswer(true);

        $post->addPost($reply);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($reply);
        $dm->flush();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->get('session')->getFlashBag()->add('notice', 'Login of register to add reply.');
            $this->get('session')->set('postAdd', $reply->getId());
            return $this->redirectToRoute('fos_user_security_login');
        }

        $this->get('session')->getFlashBag()->add('success', 'You have successfully reply to post.');

        return $this->redirectToRoute('gsup_post_show', array(
            'slug' => $post->getSlug()
        ));
    }
}