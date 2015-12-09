<?php

namespace Gsup\ForumBundle\Tests\EventListener;

/**
 * RegisterAssignContentUserListenerTest class.
 * @package Gsup\ForumBundle\Tests\EventListener
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class RegisterAssignContentUserListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /** @var FilterUserResponseEvent */
    private $event;

    /** @var AuthenticationListener */
    private $listener;

    public function setUp()
    {
        $user = $this->getMock('FOS\UserBundle\Model\UserInterface');
        $user
            ->expects($this->once())
            ->method('isEnabled')
            ->willReturn(true);

        $response = $this->getMock('Symfony\Component\HttpFoundation\Response');
        $request = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $this->event = new FilterUserResponseEvent($user, $request, $response);

        $this->eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcher');
        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch');

        $loginManager = $this->getMock('FOS\UserBundle\Security\LoginManagerInterface');

        $this->listener = new LoginAssignContentUserListener($loginManager, self::FIREWALL_NAME);
    }
}