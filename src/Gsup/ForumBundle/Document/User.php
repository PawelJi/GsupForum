<?php

namespace Gsup\ForumBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;

 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class User extends BaseUser
{

    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var int $rate
     */
    protected $rate;

    /**
     * @var Gsup\ForumBundle\Document\Post
     */
    protected $posts = array();

    /**
     * @var Gsup\ForumBundle\Document\Post
     */
    protected $postsUpdated = array();

    /**
     * @var Gsup\ForumBundle\Document\PostComment
     */
    protected $postComment = array();

    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postsUpdated = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postComment = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rate
     *
     * @param int $rate
     * @return self
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * Get rate
     *
     * @return int $rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Add post
     *
     * @param Gsup\ForumBundle\Document\Post $post
     */
    public function addPost(\Gsup\ForumBundle\Document\Post $post)
    {
        $this->posts[] = $post;
    }

    /**
     * Remove post
     *
     * @param Gsup\ForumBundle\Document\Post $post
     */
    public function removePost(\Gsup\ForumBundle\Document\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add postsUpdated
     *
     * @param Gsup\ForumBundle\Document\Post $postsUpdated
     */
    public function addPostsUpdated(\Gsup\ForumBundle\Document\Post $postsUpdated)
    {
        $this->postsUpdated[] = $postsUpdated;
    }

    /**
     * Remove postsUpdated
     *
     * @param Gsup\ForumBundle\Document\Post $postsUpdated
     */
    public function removePostsUpdated(\Gsup\ForumBundle\Document\Post $postsUpdated)
    {
        $this->postsUpdated->removeElement($postsUpdated);
    }

    /**
     * Get postsUpdated
     *
     * @return \Doctrine\Common\Collections\Collection $postsUpdated
     */
    public function getPostsUpdated()
    {
        return $this->postsUpdated;
    }

    /**
     * Add postComment
     *
     * @param Gsup\ForumBundle\Document\PostComment $postComment
     */
    public function addPostComment(\Gsup\ForumBundle\Document\PostComment $postComment)
    {
        $this->postComment[] = $postComment;
    }

    /**
     * Remove postComment
     *
     * @param Gsup\ForumBundle\Document\PostComment $postComment
     */
    public function removePostComment(\Gsup\ForumBundle\Document\PostComment $postComment)
    {
        $this->postComment->removeElement($postComment);
    }

    /**
     * Get postComment
     *
     * @return \Doctrine\Common\Collections\Collection $postComment
     */
    public function getPostComment()
    {
        return $this->postComment;
    }
}
