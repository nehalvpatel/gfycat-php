<?php

namespace Gfycat;

class Utilities
{
    public static function getRandomText($type = "alnum", $length = 10)
    {
        switch ($type) {
        case "alnum":
            $pool = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            break;
        case "alpha":
            $pool = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            break;
        case "hexdec":
            $pool = "0123456789abcdef";
            break;
        case "numeric":
            $pool = "0123456789";
            break;
        case "nozero":
            $pool = "123456789";
            break;
        case "distinct":
            $pool = "2345679ACDEFHJKLMNPRSTUVWXYZ";
            break;
        default:
            $pool = (string) $type;
            break;
        }
        
        
        $crypto_rand_secure = function ($min, $max) {
            $range = $max - $min;
            
            if ($range < 0) {
                return $min; // not so random...
            }
            
            $log    = log($range, 2);
            $bytes  = (int) ($log / 8) + 1; // length in bytes
            $bits   = (int) $log + 1; // length in bits
            $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ($rnd >= $range);
            return $min + $rnd;
        };
        
        $token = "";
        $max   = strlen($pool);
        for ($i = 0; $i < $length; $i++) {
            $token .= $pool[$crypto_rand_secure(0, $max)];
        }
        
        return $token;
    }
    
    public static function validateJSON($json, $assoc_array = false)
    {
        // decode the JSON data
        $result = json_decode($json, $assoc_array);
        
        // switch and check possible JSON errors
        switch (json_last_error()) {
        case JSON_ERROR_NONE:
            $error = ""; // JSON is valid
            break;
        case JSON_ERROR_DEPTH:
            $error = "Maximum stack depth exceeded.";
            break;
        case JSON_ERROR_STATE_MISMATCH:
            $error = "Underflow or the modes mismatch.";
            break;
        case JSON_ERROR_CTRL_CHAR:
            $error = "Unexpected control character found.";
            break;
        case JSON_ERROR_SYNTAX:
            $error = "Syntax error, malformed JSON.";
            break;
        case JSON_ERROR_UTF8:
            $error = "Malformed UTF-8 characters, possibly incorrectly encoded.";
            break;
        default:
            $error = "Unknown JSON error occurred.";
            break;
        }
        
        if ($error !== "") {
            throw new \Exception($error);
        }
        
        // everything is OK
        return $result;
    }
}