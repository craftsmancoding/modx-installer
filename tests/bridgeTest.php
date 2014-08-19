<?php
namespace ModxInstaller;

class bridgeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Could not find a valid MODX config.core.php file.
     */
    public function testGetModx()
    {
        $result = Bridge::getMODX('/');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Directory does not exist
     */
    public function testGetDir() {
        $result = Bridge::getDir('asdfa/asf');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid input
     */
    public function testGetDir2() {
        $result = Bridge::getDir(array());
    }
}