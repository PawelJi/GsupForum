<?php

namespace Gsup\ForumBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class RegisterAssignContentUserListener implements EventSubscriberInterface
{
    /**
     * @var \FOS\UserBundle\Model\UserManagerInterface
     */
    protected $_userManager;

    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    protected $_dm;

    /**
     * @param UserManagerInterface $userManager
     * @param DocumentManager $dm
     */
    public function __construct(UserManagerInterface $userManager, DocumentManager $dm)
    {
        $this->_userManager = $userManager;
        $this->_dm = $dm;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted',
            FOSUserEvents::REGISTRATION_CONFIRMED => 'onRegistrationConfirmed',
        );
    }

    /**
     * @param $request
     * @return mixed
     */
    private function _getPost($request)
    {
        if (!($session = $request->getSession())) {
            return;
        }

        if (!($stash = $session->get('addStash'))) {
            return;
        }

        $dm = $this->_dm->getManager();

        return $dm->getRepository($stash[0])->find($stash[1]);
    }

    /**
     * @param FilterUserResponseEvent $event
     */
    public function onRegistrationCompleted(FilterUserResponseEvent $event)
    {
        if (!$post = $this->_getPost($event->getRequest())) {
            return;
        };

        $post->setUser($event->getUser());
        $post->setIsActive(false);

        $this->_dm->flush();
    }

    /**
     * @param FilterUserResponseEvent $event
     */
    public function onRegistrationConfirmed(FilterUserResponseEvent $event)
    {
        foreach ($event->getUser()->getPosts() as $post) {
            $post->setIsActive(true);
        };

        $this->_dm->flush();

        $event->getRequest()
            ->getSession()
            ->remove('addStash');
    }
} 