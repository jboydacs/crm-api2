<?php

require_once 'LimeLight.php';
require_once './helpers/response_checker.php';

/**
 * For pulling data from Limelight CRM
 */

class Membership extends LimeLight {
    /**
     * @param Config $config - api configuration implementation of Limelight
     */
    public function __construct(Config $config = null) {
        $config->url .= 'membership.php';
        parent::__construct($config);
    }

    /**
     * @return Exception|null|array
     * Corresponds to Limelight's order_find method
     */
    public function orderFind() {
        try {
            parse_str($this->responseData, $data);
            if (didNotReachedServer($data)) return key($data);

            if (isRequestSuccessful($data) && array_key_exists('order_ids', $data)) {

                return ['orderIds' => explode(',', $data['order_ids'])];

            } else if (isParsedDataHasErrors($data)) {

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
    public function orderView()
    {
        try {
            parse_str($this->responseData, $data);
            if (didNotReachedServer($data)) return key($data);

            if (isRequestSuccessful($data)) {
                if (array_key_exists('data', $data)) { // multiple orders
                    $orders = json_decode($data['data']);
                    $data['data'] = $orders;
                }
                return $data;

            } else if (isParsedDataHasErrors($data)) {

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
            if (didNotReachedServer($data)) return key($data);

            if (isRequestSuccessful($data) && array_key_exists('prospect_ids', $data)) {

                return ['prospectIds' => explode(',', $data['prospect_ids'])];

            } else if (isParsedDataHasErrors($data)) {

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
            if (didNotReachedServer($data)) return key($data);

            if (isRequestSuccessful($data)) {

                return $data;

            } else if (isParsedDataHasErrors($data)) {

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
            if (didNotReachedServer($data)) return key($data);

            if (isRequestSuccessful($data)) {

                return $data;

            } else if (isParsedDataHasErrors($data)) {

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