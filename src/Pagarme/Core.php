<?php
namespace Pagarme;

/**
 * Class Core
 * @package Pagarme
 */
abstract class Core
{
    public static $api_key;
    const live        = 1;
    const endpoint    = "https://api.pagar.me";
    const api_version = '1';

    /**
     * @param $path
     * @return string
     */
    public static function full_api_url($path)
    {
        return self::endpoint . '/' . self::api_version . $path;
        // return self::endpoint . $path;
    }

    /**
     * @param $api_key
     */
    public static function setApiKey($api_key)
    {
        self::$api_key = $api_key;
    }

    /**
     * @return mixed
     */
    public static function getApiKey()
    {
        return self::$api_key;
    }

    /**
     * @param $payload
     * @param $signature
     * @return bool
     */
    public static function validateRequestSignature($payload, $signature) {
		$parts = explode("=", $signature, 2);
		return ( count($parts) == 2 ) && ( hash_hmac($parts[0], $payload, self::$api_key) == $parts[1] );
	}
    
}
