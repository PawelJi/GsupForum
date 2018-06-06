<?php

namespace Gsup\ForumBundle\Document;

 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class PostComment
{

    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $content
     */
    protected $content;

    /**
     * @var int $rate
     */
    protected $rate;

    /**
     * @var boolean $is_active
     */
    protected $is_active;

    /**
     * @var timestamp $updated_at
     */
    protected $updated_at;

    /**
     * @var timestamp $created_at
     */
    protected $created_at;

    /**
     * @var Gsup\ForumBundle\Document\User
     */
    protected $user;

    /**
     * @var Gsup\ForumBundle\Document\Post
     */
    protected $post;


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
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean $isActive
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set updatedAt
     *
     * @param timestamp $updatedAt
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return timestamp $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set createdAt
     *
     * @param timestamp $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return timestamp $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set user
     *
     * @param Gsup\ForumBundle\Document\User $user
     * @return self
     */
    public function setUser(\Gsup\ForumBundle\Document\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Gsup\ForumBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post
     *
     * @param Gsup\ForumBundle\Document\Post $post
     * @return self
     */
    public function setPost(\Gsup\ForumBundle\Document\Post $post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Get post
     *
     * @return Gsup\ForumBundle\Document\Post $post
     */
    public function getPost()
    {
        return $this->post;
    }
}
