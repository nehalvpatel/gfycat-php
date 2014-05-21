<?php

namespace Gfycat;

class Core
{
    public static function convert($url, $identifier = false)
    {
        if ($identifier === false) {
            $identifier = Utilities::getRandomText();
        }
        
        $response = file_get_contents("http://upload.gfycat.com/transcode/" . $identifier . "?fetchUrl=" . urlencode($url));
        
        return Utilities::validateJSON($response, true);
    }
    
    public static function query($id)
    {
        $response = file_get_contents("http://gfycat.com/cajax/get/" . $id);
        
        return Utilities::validateJSON($response, true);
    }
    
    public static function check($url)
    {
        $response = file_get_contents("http://gfycat.com/cajax/checkUrl/" . urlencode($url));
        
        return Utilities::validateJSON($response, true);
    }
}