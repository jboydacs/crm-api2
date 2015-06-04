<?php

include_once 'LimeLightApiService.php';

/**
 * Concrete implementation of APIService for Limelight. This caters all Limelight method calls
 * and data processing
 */

class LimeLightApiServiceImpl implements LimeLightApiService {

    /**
     * @var Api
     */
    private $api;

    /**
     * @var apiMethod
     */
    private $apiMethod;


    /**
     * @var result of API call
     */
    private $responseData;

    public function __construct(Api $api) {
        $this->api = $api;
        $this->apiMethod = $api->requestData['method'];
    }

    /**
     * @return mixed - for connecting to API
     */
    public function connect() {
        return $this->responseData = $this->api->connect();
    }

    /**
     * @return result of API call
     */
    public function getResponse() {
        return $this->responseData;
    }

    /**
     * @return mixed
     * Format response data according to the action/method provided
     */
    public function prettify() {
        // dynamic function name here
        $function = $this->apiMethodToCamelCase();
        return $this->$function();
    }


    /**
     * @return Exception|null|array
     * Corresponds to Limelight's order_find method
     */
    public function orderFind() {
        try {
            parse_str($this->responseData, $data);
            if ($this->didNotReachedServer($data)) return key($data);

            if ($this->isRequestSuccessful($data) && array_key_exists('order_ids', $data)) {

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
    private function apiMethodToCamelCase() {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->apiMethod)));
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
        return  is_array($data) && $data['response_code'] === '100';
    }

    /**
     * @param $data
     * @return bool
     * Check if api response has errors
     */
    private function isParsedDataHasErrors($data) {
        return array_key_exists('error_message', $data);
    }

    /**
     * @return mixed
     */
    public function orderView()
    {
        try {
            parse_str($this->responseData, $data);
            if ($this->didNotReachedServer($data)) return key($data);

            if ($this->isRequestSuccessful($data)) {
                if (array_key_exists('data', $data)) { // multiple orders
                    $orders = json_decode($data['data']);
                    $data['data'] = $orders;
                }
                return $data;

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
     * @return mixed
     */
    public function prospectFind()
    {
        try {
            parse_str($this->responseData, $data);
            if ($this->didNotReachedServer($data)) return key($data);

            if ($this->isRequestSuccessful($data) && array_key_exists('prospect_ids', $data)) {

                return ['prospectIds' => explode(',', $data['prospect_ids'])];

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
     * @return mixed
     */
    public function prospectView()
    {
        try {
            parse_str($this->responseData, $data);
            if ($this->didNotReachedServer($data)) return key($data);

            if ($this->isRequestSuccessful($data)) {

                return $data;

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
     * @return mixed
     */
    public function campaignView()
    {
        try {
            parse_str($this->responseData, $data);
            if ($this->didNotReachedServer($data)) return key($data);

            if ($this->isRequestSuccessful($data)) {

                return $data;

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
}