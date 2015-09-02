<?php namespace nehalvpatel;

use Guzzle\Http\Client;

class Gfycat
{
    static private $guzzle = null;

    private static function init()
    {
        if (self::$guzzle === null) {
            self::$guzzle = new \GuzzleHttp\Client();
        }
    }

    public static function convertUrl($url)
    {
        self::init();
        
        $convert_response = self::$guzzle->get("http://upload.gfycat.com/transcode?fetchUrl=" . urlencode($url))->getBody()->getContents();
        
        return json_decode($convert_response, true);
    }

    public static function convertUrlAndRelease($url)
    {
        self::init();

        $tmp = bin2hex(openssl_random_pseudo_bytes(16));
        $tmp = substr($tmp, 0 , 10); // key can only be 5-10 characters

        $convert_response = self::$guzzle->get("http://upload.gfycat.com/transcodeRelease/" . $tmp . "?fetchUrl=" . urlencode($url))->getBody()->getContents();
        $convert_json = json_decode($convert_response, true);

        if (isset($convert_json["isOk"]))
        {
            return $tmp;
        }
        else {
            return $convert_json;
        }
    }

    public static function convertFile($file)
    {
        self::init();

        $tmp = bin2hex(openssl_random_pseudo_bytes(16));
        $tmp = substr($tmp, 0 , 10); // key can only be 5-10 characters

        $upload_data = array(
            "multipart" => array(
                array(
                    "name" => "key",
                    "contents" => $tmp
                ),
                array(
                    "name" => "acl",
                    "contents" => "private"
                ),
                array(
                    "name" => "AWSAccessKeyId",
                    "contents" => "AKIAIT4VU4B7G2LQYKZQ"
                ),
                array(
                    "name" => "policy",
                    "contents" => "eyAiZXhwaXJhdGlvbiI6ICIyMDIwLTEyLTAxVDEyOjAwOjAwLjAwMFoiLAogICAgICAgICAgICAiY29uZGl0aW9ucyI6IFsKICAgICAgICAgICAgeyJidWNrZXQiOiAiZ2lmYWZmZSJ9LAogICAgICAgICAgICBbInN0YXJ0cy13aXRoIiwgIiRrZXkiLCAiIl0sCiAgICAgICAgICAgIHsiYWNsIjogInByaXZhdGUifSwKCSAgICB7InN1Y2Nlc3NfYWN0aW9uX3N0YXR1cyI6ICIyMDAifSwKICAgICAgICAgICAgWyJzdGFydHMtd2l0aCIsICIkQ29udGVudC1UeXBlIiwgIiJdLAogICAgICAgICAgICBbImNvbnRlbnQtbGVuZ3RoLXJhbmdlIiwgMCwgNTI0Mjg4MDAwXQogICAgICAgICAgICBdCiAgICAgICAgICB9"
                ),
                array(
                    "name" => "success_action_status",
                    "contents" => "200"
                ),
                array(
                    "name" => "signature",
                    "contents" => "mk9t/U/wRN4/uU01mXfeTe2Kcoc="
                ),
                array(
                    "name" => "Content-Type",
                    "contents" => "image/gif"
                ),
                array(
                    "name" => "file",
                    "contents" => $file
                )
            )
        );

        $convert_response = self::$guzzle->post("https://gifaffe.s3.amazonaws.com/", $upload_data);
        $transcode_response = self::$guzzle->post("http://upload.gfycat.com/transcode/" . $tmp);

        return json_decode($transcode_response->getBody()->getContents(), true);
    }
    
    public static function query($id)
    {
        self::init();

        $query_response = self::$guzzle->get("http://gfycat.com/cajax/get/" . $id)->getBody()->getContents();
        
        return json_decode($query_response, true);
    }
    
    public static function check($url)
    {
        self::init();

        $check_response = self::$guzzle->get("http://gfycat.com/cajax/checkUrl/" . urlencode($url))->getBody()->getContents();
        
        return json_decode($check_response, true);
    }
}