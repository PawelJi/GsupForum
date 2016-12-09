<?php

namespace Gsup\ForumBundle\Controller;

use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Repository\PostRepository;
use Hashids\Hashids;
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

        $id = $request->request->get('id'); // entity identifier
        $type = $request->request->get('type', 'post'); // entity type - post/reply
        $value = $request->request->getInt('value', 1);

        if (!in_array($value, [-1, 1])) {
            return new JsonResponse([
                'status' => 'error',
                'messages' => [
                    'Invalid value.'
                ]
            ]);
        }

        if (!in_array($type, ['post', 'reply'])) {
            return new JsonResponse([
                'status' => 'error',
                'messages' => [
                    'Invalid type.'
                ]
            ]);
        }

        // TODO configuration for secret
        $hashIds = new Hashids('some_secret_to_configure');
        // decode real id
        $id = $hashIds->decode_hex($id);

        /** @var PostRepository $repository */
        $repository = $this->get('doctrine_mongodb')->getRepository('GsupForumBundle:Post');

        if ('post' == $type) {
            /** @var Post $entity */
            $entity = $repository->findActiveById($id);
        } elseif ('reply' == $type) {
            /** @var Post $entity */
            $entity = $repository->findActiveByReplyId($id);
        } else {
            $entity = null;
        }

        if (!$entity) {
            return new JsonResponse([
                'status' => 'error',
                'messages' => [
                    'Entry does not exists.'
                ]
            ]);
        }

        // nested object should be retrieved from collection
        if ('reply' == $type) {
            $entity = $entity->getReplyById($id);
        }

        if (0 == $entity->getRate()) {
            $entity->setRate($value);
        } else {
            $entity->setRate($entity->getRate() + $value);
        }

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->flush();

        return new JsonResponse([
            'status' => 'ok',
            'rate' => $entity->getRate()
        ]);
    }
}