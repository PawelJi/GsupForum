<?php

namespace Gsup\ForumBundle\Tests\EventListener;

use FOS\UserBundle\Event\UserEvent;
use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\EventListener\LoginAssignContentUserListener;

/**
 * Class LoginAssignContentUserListenerTest
 * @package Gsup\ForumBundle\Tests\EventListener
 */
class LoginAssignContentUserListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var mixed */
    private $event;

    /** @var LoginAssignContentUserListener */
    private $listener;

    public function setUp()
    {
    }

    public function testImplicitLogin()
    {
        $userManager = $this->getMock('FOS\UserBundle\Model\UserManager');

        $dmMock = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
            ->disableOriginalConstructor()
            ->getMock();

        $dmMock->expects($this->once())
            ->method('flush');

        $repository = $this->getMockBuilder('Gsup\ForumBundle\Repository\PostRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $document = new Post();

        $repository->expects($this->once())
                ->method('find')
                ->willReturn($document)
        ;

        $dmMock->expects($this->once())
            ->method('getRepository')
            ->willReturn($repository);

        $this->listener = new LoginAssignContentUserListener($userManager, $dmMock);

        $user = $this->getMock('FOS\UserBundle\Model\UserInterface');
        $user
            ->expects($this->once())
            ->method('isEnabled')
            ->willReturn(true);

        $session = $this->getMock('Symfony\Component\HttpFoundation\Session');
        $session->method('get')
            ->willReturn(['Gsup\ForumBundle\Document\Post', 1]);

        $session
            ->expects($this->once())
            ->method('remove');

        $request = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $request->method('getSession')
                ->willReturn($session);

        $this->event = new UserEvent($user, $request);

        $this->listener->onImplicitLogin($this->event);

        $this->assertEquals($user, $document->getUser());
    }

}
 