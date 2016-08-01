<?php

namespace Tests\Gsup\ForumBundle\EventListener;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\User;
use Gsup\ForumBundle\EventListener\RegisterAssignContentUserListener;
use Gsup\ForumBundle\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * RegisterAssignContentUserListenerTest class.
 * @package Gsup\ForumBundle\Tests\EventListener
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class RegisterAssignContentUserListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var RegisterAssignContentUserListener */
    private $listener;

    /** @var FilterUserResponseEvent */
    private $event;

    /** @var Post */
    private $post;

    /** @var User */
    private $user;

    /** @var PostRepository */
    private $repository;

    /** @var Request */
    private $request;

    public function setUp()
    {
        $this->post = new Post();
        $this->user = new User();

        $userManager = $this->getMockBuilder('FOS\UserBundle\Model\UserManager')
            ->disableOriginalConstructor()
            ->getMock();

        $dmMock = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
            ->disableOriginalConstructor()
            ->getMock();

        $dmMock->expects($this->once())
            ->method('flush');

        $this->repository = $this->getMockBuilder('Gsup\ForumBundle\Repository\PostRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $dmMock->expects($this->once())
            ->method('getRepository')
            ->willReturn($this->repository);

        $this->listener = new RegisterAssignContentUserListener($userManager, $dmMock);

        $response = $this->getMock('Symfony\Component\HttpFoundation\Response');
        $this->request = $this->getMock('Symfony\Component\HttpFoundation\Request');

        $this->event = new FilterUserResponseEvent($this->user, $this->request, $response);
    }

    public function testRegistrationCompleted()
    {
        $this->repository->expects($this->once())
            ->method('find')
            ->willReturn($this->post);

        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\Session');
        $session->expects($this->once())
            ->method('get')
            ->willReturn(['Gsup\ForumBundle\Document\Post', 1]);

        $session
            ->expects($this->once())
            ->method('remove');

        $this->request->method('getSession')
            ->willReturn($session);

        $this->listener->onRegistrationCompleted($this->event);

        $this->assertEquals($this->user, $this->post->getUser());
        $this->assertFalse($this->post->getIsActive());
    }

    public function testRegistrationConfirmed()
    {
        $this->post->setIsActive(false);

        $this->repository->expects($this->once())
            ->method('findAllInActiveByUser')
            ->willReturn([
                $this->post
            ]);

        $this->listener->onRegistrationConfirmed($this->event);

        $this->assertTrue($this->post->getIsActive());
    }

}