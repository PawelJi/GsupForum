<?php

namespace Gsup\ForumBundle\Controller;

use Gsup\ForumBundle\Document\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * VoteController class.
 * @package Gsup\ForumBundle\Controller
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class VoteController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function voteAction(Request $request)
    {
        // TODO user could only add one vote in one topic, so when want to add more then one, should remove first decision
        // TODO could add one vote for question and one vote for reply
        // TODO quiet important is that all choices should be persisted in vote log - for restoring and counting purposes

        $id = $request->request->get('id'); // identifier of reply or when null - vote for question
        $postId = $request->request->get('pid'); // post id - slug
        $type = $request->request->get('type', 'up'); // up or down voting

        /** @var Post $post */
        $post = $this->get('doctrine_mongodb')
            ->getRepository('GsupForumBundle:Post')
            ->findActiveBySlug($postId);

        if (!$post) {
            return new JsonResponse([
                'status' => 'error'
            ]);
        }

        /** @var Post $post */
        $reply = $this->get('doctrine_mongodb')
            ->getRepository('GsupForumBundle:Post')
            ->findActiveBySlug($postId);

    }
}