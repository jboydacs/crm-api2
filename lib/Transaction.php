<?php

require_once 'LimeLight.php';
require_once '../helpers/response_checker.php';


class Transaction extends LimeLight {
    /**
     * @param Config $config - api configuration implementation of Limelight
     */
    public function __construct(Config $config = null) {
        $config->url .= 'transact.php';
        parent::__construct($config);
    }

    /**
     * @return mixed
     */
    public function newOrder()
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