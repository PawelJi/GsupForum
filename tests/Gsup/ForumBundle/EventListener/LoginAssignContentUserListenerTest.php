<?php

namespace Tests\Gsup\ForumBundle\EventListener;

use FOS\UserBundle\Event\UserEvent;
use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\User;
use Gsup\ForumBundle\EventListener\LoginAssignContentUserListener;

/**
 * LoginAssignContentUserListenerTest class.
 * @package Gsup\ForumBundle\Tests\EventListener
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
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
        $userManager = $this->getMockBuilder('FOS\UserBundle\Model\UserManager')
            ->disableOriginalConstructor()
            ->getMock();

        $dmMock = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
            ->disableOriginalConstructor()
            ->getMock();

        $dmMock->expects($this->once())
            ->method('flush');

        $repository = $this->getMockBuilder('Gsup\ForumBundle\Repository\PostRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $post = new Post();

        $repository->expects($this->once())
                ->method('find')
                ->willReturn($post)
        ;

        $dmMock->expects($this->once())
            ->method('getRepository')
            ->willReturn($repository);

        $this->listener = new LoginAssignContentUserListener($userManager, $dmMock);

        $user = new User();

        $session = $this->createMock('Symfony\Component\HttpFoundation\Session\Session');
        $session->expects($this->once())
            ->method('get')
            ->willReturn(['Gsup\ForumBundle\Document\Post', 1]);

        $session
            ->expects($this->once())
            ->method('remove');

        $request = $this->createMock('Symfony\Component\HttpFoundation\Request');
        $request->method('getSession')
                ->willReturn($session);

        $this->event = new UserEvent($user, $request);

        $this->listener->onImplicitLogin($this->event);

        $this->assertEquals($user, $post->getUser());
    }

}
 