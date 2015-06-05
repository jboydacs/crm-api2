<?php

include_once 'services/ApiService.php';
include_once 'services/OrderService.php';

/**
 * Class for testing Limelight CRM API
 */
class LimeLightContext {

    /**
     * @var LimeLightApiService
     */
    private $apiService;

    /**
     * @param Config $config
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService) {
        $this->apiService = $apiService;
    }

    /**
     * Trigger api test
     * @return string Trigger api test
     */
    public function test() {
        $rawResponse = $this->apiService->connect();
        $orders = $this->apiService->prettify();

        $orderService = new OrderService();
        return $orderService->cook($orders);
    }
}