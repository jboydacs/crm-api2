<?php

include_once 'Api.php';
include_once './exceptions/FailedToConnectException.php';

class LimeLightApi extends Api {
    private $config;

    public function __construct($config = null, $method = null) {
        parent::__construct($config);
        $this->config = $config;
    }

    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }

    public function connect($data) {

        $data['username'] = $this->config->user;
        $data['password'] = $this->config->key;
        try {
            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, $this->config->url);
            curl_setopt($curlSession, CURLOPT_HEADER, 0);
            curl_setopt($curlSession, CURLOPT_POST, 1);
            curl_setopt($curlSession, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curlSession, CURLOPT_TIMEOUT,5000);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 2);

            $response = curl_exec($curlSession);

            // Check that a connection was made
            if (curl_error($curlSession)){
                // If it wasn't...
                $output['Status'] = "FAIL";
                $output['StatusDetail'] = curl_error($curlSession);
            }

            curl_close ($curlSession);
            return $response;

        }catch (Exception $e) {
            throw new FailedToConnectException('Failed to connect to the api');
        }

    }
}