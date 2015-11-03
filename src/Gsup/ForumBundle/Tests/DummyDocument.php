<?php

namespace Gsup\ForumBundle\Tests;
use Gsup\ForumBundle\Traits\DocumentCapacity;

/**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class DummyDocument
{
    use DocumentCapacity;

    /**
     * @var mixed
     */
    protected $name;

    /**
     * @var mixed
     */
    protected  $address;

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

} 