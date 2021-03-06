<?php

include_once 'CRMApi.php';
include_once 'Config.php';
include_once './helpers/utils.php';
include_once './helpers/response_checker.php';
include_once './exceptions/FailedToConnectException.php';
include_once './exceptions/RequestMethodNotFoundException.php';
include_once './exceptions/ApiCallFailedException.php';

/**
 * For interacting with Limelight CRM api
 */

class LimeLight extends CRMApi {
    /**
     * @var
     */
    private $config;

    /**
     * @var
     */
    private $requestData;


    /**
     * @var result of API call
     */
    protected $responseData;

    /**
     * @param Config $config - api configuration implementation of Limelight
     */
    public function __construct(Config $config = null) {
        $this->config = $config;
    }

    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }

    /**
     * @return mixed
     * @throws FailedToConnectException
     * @throws RequestMethodNotFoundException
     */
    public function connect() {

        if (!hasRequestMethod($this->requestData)) {
            throw new RequestMethodNotFoundException('Request Method Not Found');
        }

        $this->requestData['username'] = $this->config->user;
        $this->requestData['password'] = $this->config->key;

        try {
            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, $this->config->url);
            curl_setopt($curlSession, CURLOPT_HEADER, 0);
            curl_setopt($curlSession, CURLOPT_POST, 1);
            curl_setopt($curlSession, CURLOPT_POSTFIELDS, http_build_query($this->requestData));
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curlSession, CURLOPT_TIMEOUT,5000);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 2);

            $this->responseData = curl_exec($curlSession);

            // Check that a connection was made
            if (curl_error($curlSession)){
                throw new ApiCallFailedException('Api Call Failed');
            }

            curl_close ($curlSession);

        }catch (Exception $e) {
            throw new FailedToConnectException('Failed to connect to the api');
        }
    }

    /**
     * @return mixed
     * Format response data according to the action/method provided
     */
    public function evalMethod() {
        // dynamic function name here
        return apiMethodToCamelCase($this->requestData['method']);
    }
}