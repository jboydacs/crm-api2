<?php

class OrderService {


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