<?php

include_once 'ApiService.php';

/**
 * Class LimeLightApiService - concrete implement of APIService for Limelight. This caters all Limelight method calls
 * and data processing
 */

class LimeLightApiService implements ApiService {
    /**
     * @var Api
     */
    private $api;

    /**
     * @var result of API call
     */
    private $responseData;

    public function __construct(Api $api) {
        $this->api = $api;
    }

    /**
     * Trigger API call
     */
    public function connect() {
        $this->responseData = $this->api->connect();
    }

    /**
     * @return result of API call
     */
    public function getResponse() {
        return $this->responseData;
    }

    /**
     * @param $action
     * @return mixed
     * Format response data according to the action/method provided
     */
    public function prettify($action) {
        // dynamic function name here
        $function = $this->apiMethodToCamelCase($action);
        return $this->$function();
    }


    /**
     * @return Exception|null|array
     * Corresponds to Limelight's order_find method
     */
    private function orderFind() {
        try {
            parse_str($this->responseData, $data);
            if ($this->didNotReachedServer($data)) return key($data);

            if ($this->isRequestSuccessful($data)) {

                return ['orderIds' => explode(',', $data['order_ids'])];

            } else if ($this->isParsedDataHasErrors($data)) {

                return $data['error_message'];

            } else {    // unknown stuffs
                return $data;
            }
        } catch (Exception $e) {
            return $e;
        }
        return null;
    }

    /**
     * @param $action
     * @return string - camel case of action/method
     */
    private function apiMethodToCamelCase($action) {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $action)));
        return lcfirst($str);
    }

    /**
     * @param $data
     * @return bool
     * Check if the api call successfully reached the server
     */
    private function didNotReachedServer($data) {
        return !array_key_exists('response_code', $data);
    }

    /**
     * @param $data
     * @return bool
     * Check if Limelight api call is ok. 100 response code means success
     */
    private function isRequestSuccessful($data) {
        return  is_array($data) &&
        $data['response_code'] === '100' &&
        array_key_exists('total_orders', $data);
    }

    /**
     * @param $data
     * @return bool
     * Check if api response has errors
     */
    private function isParsedDataHasErrors($data) {
        return array_key_exists('error_message', $data);
    }

}