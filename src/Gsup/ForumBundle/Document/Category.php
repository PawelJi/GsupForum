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
class Category
{
    
    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var int $stats_posts
     */
    protected $stats_posts;

    /**
     * @var \Gsup\ForumBundle\Document\Category
     */
    protected $ancestor = array();

    public function __construct()
    {
        $this->ancestor = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get parentId
     *
     * @return int $parentId
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
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
     * Set statsPosts
     *
     * @param int $statsPosts
     * @return self
     */
    public function setStatsPosts($statsPosts)
    {
        $this->stats_posts = $statsPosts;
        return $this;
    }

    /**
     * Get statsPosts
     *
     * @return int $statsPosts
     */
    public function getStatsPosts()
    {
        return $this->stats_posts;
    }
    
    /**
     * Add ancestor
     *
     * @param \Gsup\ForumBundle\Document\Category $ancestor
     */
    public function addAncestor(\Gsup\ForumBundle\Document\Category $ancestor)
    {
        $this->ancestor[] = $ancestor;
    }

    /**
     * Remove ancestor
     *
     * @param \Gsup\ForumBundle\Document\Category $ancestor
     */
    public function removeAncestor(\Gsup\ForumBundle\Document\Category $ancestor)
    {
        $this->ancestor->removeElement($ancestor);
    }

    /**
     * Get ancestor
     *
     * @return \Doctrine\Common\Collections\Collection $ancestor
     */
    public function getAncestor()
    {
        return $this->ancestor;
    }
}
