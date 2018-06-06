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
}
