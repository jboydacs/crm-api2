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
        print_r($data);
    }
}