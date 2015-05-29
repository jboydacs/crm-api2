<?php

include_once 'ApiService.php';

class LimeLightApiService implements ApiService {
    private $method;

    public function __construct($method = null) {
        $this->method = $method;
    }

    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }

    private function apiMethodToCamelCase() {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->method)));
        return lcfirst($str);
    }

    public function prettify($responseData) {
        // dynamic function name here
        $function = $this->apiMethodToCamelCase();
        return $this->$function($responseData);
    }

    /**
     * @param $responseData
     * @return Exception|null|array
     */
    public function orderFind($responseData) {
        try {
            parse_str($responseData, $data);
            if ($this->didNotReachedServer($data)) return key($data);

            if ($this->isRequestSuccessful($data)) {

                return ['ordersIds' => explode(',', $data['order_ids'])];

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