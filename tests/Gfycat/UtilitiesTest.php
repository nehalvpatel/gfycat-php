<?php

/**
 * UtilitiesTest Class Doc Comment
 *
 * @category Tests
 * @package  Gfycat
 * @author   Nehal Patel <nehal@itspatel.com>
 * @license  http://opensource.org/licenses/MIT MIT license
 * @link     https://packagist.org/packages/nehalvpatel/gfycat-php
 */
class UtilitiesTest extends \PHPUnit_Framework_TestCase
{
    function testGetRandomText()
    {
        $this->assertNotEmpty(\Gfycat\Utilities::getRandomText());
    }
    
    function testValidateJSON()
    {
        $json = json_encode(array());
        $this->assertEquals(array(), \Gfycat\Utilities::validateJSON($json));
    }
}
