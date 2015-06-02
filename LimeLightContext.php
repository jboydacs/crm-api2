<?php

include_once 'lib/Config.php';
include_once 'lib/LimeLightApi.php';
include_once 'services/LimeLightApiService.php';
include_once 'services/OrderService.php';

/**
 * Class LimeLightContext - for testing Limelight CRM API
 */
class LimeLightContext {
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * @param $action
     * @return string
     * Trigger api test
     */
    public function fire($action) {
        $data = array(
            'campaign_id' => 'all',
            'criteria' => 'all',
            'start_date' => '05/27/2015',
            'start_time' => '00:00:00',
            'end_date' => '05/30/2015',
            'end_time' => '23:59:59',
            'search_type' => 'any',
            'return_type' => ''
        );
        $data['method'] = $action;

        $api = new LimeLightApi($this->config);
        $api->requestData = $data;

        $apiService = new LimeLightApiService($api);
        $apiService->connect();
        $orders = $apiService->prettify($action);

        $orderService = new OrderService();
        return $orderService->cook($orders);
    }
}