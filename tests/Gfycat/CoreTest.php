<?php

/**
 * CoreTest Class Doc Comment
 *
 * @category Tests
 * @package  Gfycat
 * @author   Nehal Patel <nehal@itspatel.com>
 * @license  http://opensource.org/licenses/MIT MIT license
 * @link     https://packagist.org/packages/nehalvpatel/gfycat-php
 */
class CoreTest extends \PHPUnit_Framework_TestCase
{
    function testConvert()
    {
        $response = \Gfycat\Core::convert("http://i.imgur.com/jmLX0nv.gif");
        $this->assertEquals("InstructiveUnsungBabirusa", $response["gfyName"]);
    }
    
    function testQuery()
    {
        $response = \Gfycat\Core::query("InstructiveUnsungBabirusa");
        $this->assertEquals("999878226", $response["gfyItem"]["gfyNumber"]);
    }
    
    function testCheck()
    {
        $response = \Gfycat\Core::check("http://i.imgur.com/jmLX0nv.gif");
        $this->assertEquals("InstructiveUnsungBabirusa", $response["gfyName"]);
    }
}
