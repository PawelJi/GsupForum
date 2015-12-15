<?php

namespace Gsup\ForumBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ODM\MongoDB\DocumentManager;


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
    /** @var UserManagerInterface */
    protected $_userManager;

    /** @var DocumentManager */
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
        if (!($stack = $session->get('assignUserStack'))) {
            return;
        }

        return $this->_dm->getRepository($stack[0])->find($stack[1]);
    }

    /**
     * @param FilterUserResponseEvent $event
     */
    public function onRegistrationCompleted(FilterUserResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$post = $this->_getPost($request)) {
            return;
        }

        $post->setUser($event->getUser());
        $post->setIsActive(false);

        $this->_dm->flush();

        $request->getSession()->remove('assignUserStack');
    }

    /**
     * @param FilterUserResponseEvent $event
     */
    public function onRegistrationConfirmed(FilterUserResponseEvent $event)
    {
        $posts = $this->_dm->getRepository('GsupForumBundle:Post')
            ->findAllInActiveByUser($event->getUser());

        foreach ($posts as $post) {
            $post->setIsActive(true);
        }

        $this->_dm->flush();
    }
} 