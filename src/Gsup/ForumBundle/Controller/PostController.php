<?php

namespace Gsup\ForumBundle\Controller;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\Reply;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use As3\ShortMongoId\Shortener;

/**
 * Class PostController
 * @package Gsup\ForumBundle\Controller
 */
class PostController extends Controller
{
    public function createAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm('Gsup\ForumBundle\Form\PostType', $post, array(
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
            $this->get('session')->getFlashBag()->add('notice', 'Login or register to add new post.');
            $this->get('session')->set('assignUserStack', ['GsupForumBundle:Post', $post->getId()]);
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
                'form' => $this->createForm('Gsup\ForumBundle\Form\ReplyType', null, array(
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

        $reply = new Reply();

        $form = $this->createForm('Gsup\ForumBundle\Form\ReplyType', $reply, array(
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if (!$form->isValid()) {
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

        $post->addReply($reply);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->flush();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->get('session')->getFlashBag()->add('notice', 'Login or register to add reply.');
            $this->get('session')->set('assignUserStack', ['GsupForumBundle:Reply', $reply->getId()]);
            return $this->redirectToRoute('fos_user_security_login');
        }

        $this->get('session')->getFlashBag()->add('success', 'You have successfully reply to post.');

        return $this->redirectToRoute('gsup_post_show', array(
            'slug' => $post->getSlug()
        ));
    }
}