<?php

namespace Gsup\ForumBundle\Services;

/**
 * IdEncoderService class.
 * @package Gsup\ForumBundle\Services
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class IdEncoderService extends \PHPUnit_Framework_TestCase
{
    /**
     * Encode string id.
     *
     * @param $id
     * @return string
     */
    public function encode($id)
    {
        return rtrim(strtr(base64_encode(hex2bin($id)), '+/', '-_'), '=');
    }

    /**
     * Decode string id.
     *
     * @param $id
     * @return string
     */
    public function decode($id)
    {
        return bin2hex(base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT)));
    }
}