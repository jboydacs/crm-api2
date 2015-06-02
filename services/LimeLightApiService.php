<?php

include_once 'ApiService.php';

class LimeLightApiService implements ApiService {
    private $api;
    private $responseData;

    public function __construct(Api $api) {
        $this->api = $api;
    }

    public function connect() {
        $this->responseData = $this->api->connect();
    }

    public function getResponse() {
        return $this->responseData;
    }

    public function prettify($action) {
        // dynamic function name here
        $function = $this->apiMethodToCamelCase($action);
        return $this->$function();
    }


    /**
     * @return Exception|null|array
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

    private function apiMethodToCamelCase($action) {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $action)));
        return lcfirst($str);
    }

    private function didNotReachedServer($data) {
        return !array_key_exists('response_code', $data);
    }

    private function isRequestSuccessful($data) {
        return  is_array($data) &&
        $data['response_code'] === '100' &&
        array_key_exists('total_orders', $data);
    }

    private function isParsedDataHasErrors($data) {
        return array_key_exists('error_message', $data);
    }

}