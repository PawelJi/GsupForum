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
class Reply 
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
     * @var int $stats_comment
     */
    protected $stats_comment;

    /**
     * @var boolean $is_authorized_user
     */
    protected $is_authorized_user;

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
     * @var \Gsup\ForumBundle\Document\Comment
     */
    protected $comment = array();

    /**
     * @var \Gsup\ForumBundle\Document\User
     */
    protected $user;

    /**
     * @var \Gsup\ForumBundle\Document\User
     */
    protected $userLastUpdated;

    public function __construct()
    {
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set statsComment
     *
     * @param int $statsComment
     * @return self
     */
    public function setStatsComment($statsComment)
    {
        $this->stats_comment = $statsComment;
        return $this;
    }

    /**
     * Get statsComment
     *
     * @return int $statsComment
     */
    public function getStatsComment()
    {
        return $this->stats_comment;
    }

    /**
     * Set isAuthorizedUser
     *
     * @param boolean $isAuthorizedUser
     * @return self
     */
    public function setIsAuthorizedUser($isAuthorizedUser)
    {
        $this->is_authorized_user = $isAuthorizedUser;
        return $this;
    }

    /**
     * Get isAuthorizedUser
     *
     * @return boolean $isAuthorizedUser
     */
    public function getIsAuthorizedUser()
    {
        return $this->is_authorized_user;
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
     * Add comment
     *
     * @param \Gsup\ForumBundle\Document\Comment $comment
     */
    public function addComment(\Gsup\ForumBundle\Document\Comment $comment)
    {
        $this->comment[] = $comment;
    }

    /**
     * Remove comment
     *
     * @param \Gsup\ForumBundle\Document\Comment $comment
     */
    public function removeComment(\Gsup\ForumBundle\Document\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection $comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param \Gsup\ForumBundle\Document\User $user
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
     * @return \Gsup\ForumBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set userLastUpdated
     *
     * @param \Gsup\ForumBundle\Document\User $userLastUpdated
     * @return self
     */
    public function setUserLastUpdated(\Gsup\ForumBundle\Document\User $userLastUpdated)
    {
        $this->userLastUpdated = $userLastUpdated;
        return $this;
    }

    /**
     * Get userLastUpdated
     *
     * @return \Gsup\ForumBundle\Document\User $userLastUpdated
     */
    public function getUserLastUpdated()
    {
        return $this->userLastUpdated;
    }
    /**
     * @var timestamp $updated_any_at
     */
    protected $updated_any_at;

    /**
     * @var \Gsup\ForumBundle\Document\User
     */
    protected $userLastEdit;


    /**
     * Set updatedAnyAt
     *
     * @param timestamp $updatedAnyAt
     * @return self
     */
    public function setUpdatedAnyAt($updatedAnyAt)
    {
        $this->updated_any_at = $updatedAnyAt;
        return $this;
    }

    /**
     * Get updatedAnyAt
     *
     * @return timestamp $updatedAnyAt
     */
    public function getUpdatedAnyAt()
    {
        return $this->updated_any_at;
    }

    /**
     * Set userLastEdit
     *
     * @param \Gsup\ForumBundle\Document\User $userLastEdit
     * @return self
     */
    public function setUserLastEdit(\Gsup\ForumBundle\Document\User $userLastEdit)
    {
        $this->userLastEdit = $userLastEdit;
        return $this;
    }

    /**
     * Get userLastEdit
     *
     * @return \Gsup\ForumBundle\Document\User $userLastEdit
     */
    public function getUserLastEdit()
    {
        return $this->userLastEdit;
    }
}
