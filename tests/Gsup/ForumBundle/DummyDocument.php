<?php

namespace Tests\Gsup\ForumBundle;

use Gsup\ForumBundle\Traits\DocumentCapacityTrait;

/**
 * DummyDocument class.
 * @package Gsup\ForumBundle\Tests
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class DummyDocument
{
    use DocumentCapacityTrait;

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