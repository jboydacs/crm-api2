<?php

include_once 'CrmService.php';

/**
 * Service for processing orders coming from the limelight CRM
 */

class OrderService implements CrmService {


    /**
     * @param $data
     * @return string
     *
     */
    public function cook($data) {
        if (is_array($data) && array_key_exists('orderIds', $data)) {
            // TODO: process order ids here
            return 'Orders processed!';
        } else {
            // TODO: Log
            return $data;
        }
    }
}