<?php

namespace Gsup\ForumBundle\EventListener;

use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class LoginPostAddListener extends EventSubscriberInterface
{
    /**
     * @var \FOS\UserBundle\Model\UserManagerInterface
     */
    protected $_userManager;

    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    protected $dm;

    public function __construct(UserManagerInterface $userManager, DocumentManager $dm)
    {
        $this->_userManager = $userManager;
        $this->_dm = $dm;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );
    }

    private function _updatePost($request, $user)
    {
        if (!($session = $request->getSession())) {
            return;
        }

        if (!($id = $session->get('postAdd'))) {
            return;
        }

        $session->remove('postAdd');

        $dm = $this->_dm->getManager();

        $post = $dm->getRepository('GsupForumBundle:Post')->find($id);

        if (!$post) {
            return;
        }

        $post->setUser($user);

        $dm->flush();
    }

    public function onImplicitLogin(UserEvent $event)
    {
        $this->_updatePost($event->getRequest(), $event->getUser());
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->_updatePost($event->getRequest(), $event->getAuthenticationToken()->getUser());
    }

} 