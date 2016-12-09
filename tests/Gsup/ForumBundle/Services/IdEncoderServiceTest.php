<?php
namespace Tests\Gsup\ForumBundle\Services;

use Gsup\ForumBundle\Services\IdEncoderService;

/**
 * IdEncoderService class.
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class IdEncoderServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var IdEncoderService */
    protected $_service;

    protected function setUp()
    {
        $this->_service = new IdEncoderService();
    }

    public function testEncode()
    {
        $this->assertEquals('Vjh_uV8a3RGTAEWe', $this->_service->encode('56387fb95f1add119300459e'));
        $this->assertEquals('Vjh_rV8a3RGTAEGn', $this->_service->encode('56387fad5f1add11930041a7'));
        $this->assertEquals('Vjh_rV8a3RGTAEHP', $this->_service->encode('56387fad5f1add11930041cf'));
        $this->assertEquals('WEpo7icY90OHPFax', $this->_service->encode('584a68ee2718f743873c56b1'));
        $this->assertEquals('WEpo9ScY90OHPFay', $this->_service->encode('584a68f52718f743873c56b2'));
    }

    public function testDecode()
    {
        $this->assertEquals('56387fb95f1add119300459e', $this->_service->decode('Vjh_uV8a3RGTAEWe'));
        $this->assertEquals('56387fad5f1add11930041a7', $this->_service->decode('Vjh_rV8a3RGTAEGn'));
        $this->assertEquals('56387fad5f1add11930041cf', $this->_service->decode('Vjh_rV8a3RGTAEHP'));
        $this->assertEquals('584a68ee2718f743873c56b1', $this->_service->decode('WEpo7icY90OHPFax'));
        $this->assertEquals('584a68f52718f743873c56b2', $this->_service->decode('WEpo9ScY90OHPFay'));
    }
}