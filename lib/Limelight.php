<?php

require_once './common/utils.php';

final class Limelight
{
    function __construct() {}
    function __destruct() {}

    static function method($method, $data)
    {
        return self::$method($data);
    }

    private static function connect($data)
    {
        try {
            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, $data['url']);
            curl_setopt($curlSession, CURLOPT_HEADER, 0);
            curl_setopt($curlSession, CURLOPT_POST, 1);
            curl_setopt($curlSession, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curlSession, CURLOPT_TIMEOUT,5000);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 2);

            return $curlSession;
        }catch (Exception $e) {
            return $e->getMessage();
        }
        return null;
    }

    private static function orderFind($data)
    {
        $curlSession = self::connect($data);
        $responseData = curl_exec($curlSession);
        curl_close ($curlSession);

        return $responseData;
    }
}