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
     * @var int $parent_id
     */
    protected $parent_id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var string $string_path
     */
    protected $string_path;

    /**
     * @var string $numeric_path
     */
    protected $numeric_path;

    /**
     * @var int $stats_posts
     */
    protected $stats_posts;


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
     * Set parentId
     *
     * @param int $parentId
     * @return self
     */
    public function setParentId($parentId)
    {
        $this->parent_id = $parentId;
        return $this;
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
     * Set stringPath
     *
     * @param string $stringPath
     * @return self
     */
    public function setStringPath($stringPath)
    {
        $this->string_path = $stringPath;
        return $this;
    }

    /**
     * Get stringPath
     *
     * @return string $stringPath
     */
    public function getStringPath()
    {
        return $this->string_path;
    }

    /**
     * Set numericPath
     *
     * @param string $numericPath
     * @return self
     */
    public function setNumericPath($numericPath)
    {
        $this->numeric_path = $numericPath;
        return $this;
    }

    /**
     * Get numericPath
     *
     * @return string $numericPath
     */
    public function getNumericPath()
    {
        return $this->numeric_path;
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
}
