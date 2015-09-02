<?php

/**
 * CoreTest Class Doc Comment
 *
 * @category Tests
 * @package  Gfycat
 * @author   Nehal Patel <nehal.patel@me.com>
 * @license  http://opensource.org/licenses/MIT MIT license
 * @link     https://packagist.org/packages/nehalvpatel/gfycat-php
 */
class CoreTest extends \PHPUnit_Framework_TestCase
{
    function testConvertUrl()
    {
        $response = \nehalvpatel\Gfycat::convertUrl("http://i.imgur.com/gTv0isU.gif");
        $this->assertEquals("SpryFixedGnu", $response["gfyName"]);
    }

    function testConvertUrlAndRelease()
    {
        $response = \nehalvpatel\Gfycat::convertUrlAndRelease("http://i.imgur.com/gTv0isU.gif");
        $this->assertEquals("SpryFixedGnu", $response["gfyName"]);
    }

    function testConvertFile()
    {
        $response = \nehalvpatel\Gfycat::convertFile(stream_get_contents(fopen("http://i.imgur.com/gTv0isU.gif", "r")));
        $this->assertEquals("SpryFixedGnu", $response["gfyName"]);
    }
    
    function testQuery()
    {
        $response = \nehalvpatel\Gfycat::query("SpryFixedGnu");
        $this->assertEquals("862512708", $response["gfyItem"]["gfyNumber"]);
    }
    
    function testCheck()
    {
        $response = \nehalvpatel\Gfycat::check("http://i.imgur.com/gTv0isU.gif");
        $this->assertEquals("SpryFixedGnu", $response["gfyName"]);
    }
}
