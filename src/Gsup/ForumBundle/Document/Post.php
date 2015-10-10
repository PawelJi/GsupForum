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
class Post
{

    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var string $content
     */
    protected $content;

    /**
     * @var int $rate
     */
    protected $rate;

    /**
     * @var hash $tags
     */
    protected $tags;

    /**
     * @var int $stats_comment
     */
    protected $stats_comment;

    /**
     * @var int $stats_view
     */
    protected $stats_view;

    /**
     * @var int $stats_answer
     */
    protected $stats_answer;

    /**
     * @var boolean $is_authorized_user
     */
    protected $is_authorized_user;

    /**
     * @var boolean $is_request_open
     */
    protected $is_request_open;

    /**
     * @var boolean $is_request_close
     */
    protected $is_request_close;

    /**
     * @var boolean $is_answer
     */
    protected $is_answer;

    /**
     * @var boolean $is_resolved
     */
    protected $is_resolved;

    /**
     * @var boolean $is_closed
     */
    protected $is_closed;

    /**
     * @var boolean $is_active
     */
    protected $is_active;

    /**
     * @var timestamp $updated_at
     */
    protected $updated_at;

    /**
     * @var timestamp $updated_any_at
     */
    protected $updated_any_at;

    /**
     * @var timestamp $created_at
     */
    protected $created_at;

    /**
     * @var Gsup\ForumBundle\Document\Category
     */
    protected $category;

    /**
     * @var Gsup\ForumBundle\Document\Post
     */
    protected $posts = array();

    /**
     * @var Gsup\ForumBundle\Document\PostComment
     */
    protected $postComment = array();

    /**
     * @var Gsup\ForumBundle\Document\User
     */
    protected $user;

    /**
     * @var Gsup\ForumBundle\Document\User
     */
    protected $userLastUpdated;

    /**
     * @var Gsup\ForumBundle\Document\User
     */
    protected $userLastUpdatedAny;

    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set tags
     *
     * @param hash $tags
     * @return self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return hash $tags
     */
    public function getTags()
    {
        return $this->tags;
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
     * Set statsView
     *
     * @param int $statsView
     * @return self
     */
    public function setStatsView($statsView)
    {
        $this->stats_view = $statsView;
        return $this;
    }

    /**
     * Get statsView
     *
     * @return int $statsView
     */
    public function getStatsView()
    {
        return $this->stats_view;
    }

    /**
     * Set statsAnswer
     *
     * @param int $statsAnswer
     * @return self
     */
    public function setStatsAnswer($statsAnswer)
    {
        $this->stats_answer = $statsAnswer;
        return $this;
    }

    /**
     * Get statsAnswer
     *
     * @return int $statsAnswer
     */
    public function getStatsAnswer()
    {
        return $this->stats_answer;
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
     * Set isRequestOpen
     *
     * @param boolean $isRequestOpen
     * @return self
     */
    public function setIsRequestOpen($isRequestOpen)
    {
        $this->is_request_open = $isRequestOpen;
        return $this;
    }

    /**
     * Get isRequestOpen
     *
     * @return boolean $isRequestOpen
     */
    public function getIsRequestOpen()
    {
        return $this->is_request_open;
    }

    /**
     * Set isRequestClose
     *
     * @param boolean $isRequestClose
     * @return self
     */
    public function setIsRequestClose($isRequestClose)
    {
        $this->is_request_close = $isRequestClose;
        return $this;
    }

    /**
     * Get isRequestClose
     *
     * @return boolean $isRequestClose
     */
    public function getIsRequestClose()
    {
        return $this->is_request_close;
    }

    /**
     * Set isAnswer
     *
     * @param boolean $isAnswer
     * @return self
     */
    public function setIsAnswer($isAnswer)
    {
        $this->is_answer = $isAnswer;
        return $this;
    }

    /**
     * Get isAnswer
     *
     * @return boolean $isAnswer
     */
    public function getIsAnswer()
    {
        return $this->is_answer;
    }

    /**
     * Set isResolved
     *
     * @param boolean $isResolved
     * @return self
     */
    public function setIsResolved($isResolved)
    {
        $this->is_resolved = $isResolved;
        return $this;
    }

    /**
     * Get isResolved
     *
     * @return boolean $isResolved
     */
    public function getIsResolved()
    {
        return $this->is_resolved;
    }

    /**
     * Set isClosed
     *
     * @param boolean $isClosed
     * @return self
     */
    public function setIsClosed($isClosed)
    {
        $this->is_closed = $isClosed;
        return $this;
    }

    /**
     * Get isClosed
     *
     * @return boolean $isClosed
     */
    public function getIsClosed()
    {
        return $this->is_closed;
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
     * Set category
     *
     * @param Gsup\ForumBundle\Document\Category $category
     * @return self
     */
    public function setCategory(\Gsup\ForumBundle\Document\Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Gsup\ForumBundle\Document\Category $category
     */
    public function getCategory()
    {
        return $this->category;
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
     * Set userLastUpdated
     *
     * @param Gsup\ForumBundle\Document\User $userLastUpdated
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
     * @return Gsup\ForumBundle\Document\User $userLastUpdated
     */
    public function getUserLastUpdated()
    {
        return $this->userLastUpdated;
    }

    /**
     * Set userLastUpdatedAny
     *
     * @param Gsup\ForumBundle\Document\User $userLastUpdatedAny
     * @return self
     */
    public function setUserLastUpdatedAny(\Gsup\ForumBundle\Document\User $userLastUpdatedAny)
    {
        $this->userLastUpdatedAny = $userLastUpdatedAny;
        return $this;
    }

    /**
     * Get userLastUpdatedAny
     *
     * @return Gsup\ForumBundle\Document\User $userLastUpdatedAny
     */
    public function getUserLastUpdatedAny()
    {
        return $this->userLastUpdatedAny;
    }
}
