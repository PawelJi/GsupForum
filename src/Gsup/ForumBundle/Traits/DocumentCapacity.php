<?php
 
namespace Gsup\ForumBundle\Traits;

/**
 * Class DocumentCapacity
 *
 * @package Gsup\ForumBundle\Traits
 */
trait DocumentCapacity
{
    /**
     * Set values from given array.
     *
     * @param array $data
     */
    public function setFromArray($data = array())
    {
        foreach ($data as $property => $value) {
            $method = "set{$property}";
            $this->$method($value);
        }
    }
} 