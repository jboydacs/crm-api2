<?php


include_once 'lib/LimeLightApi.php';
include_once 'lib/Config.php';
include_once 'services/LimeLightApiService.php';

class LimeLightContext {
    // wiring
    private $config;
    private $service;

    public function __construct(LimeLightConfig $config, LimeLightApiService $service) {
        $this->config = $config;
        $this->service = $service;
    }

    public function fire($action) {
        $data = Array(
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

        $ll = new LimeLightApi($this->config);
        $ll->requestData = $data;
        $result = $ll->connect();
        $s = new LimeLightApiService($ll->requestData['method']);

        $orders = $s->prettify($result);
        return $s->cookIt($orders);
    }
}