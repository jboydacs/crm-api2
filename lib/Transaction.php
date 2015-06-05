<?php

include_once 'LimeLightApi.php';


class Transaction extends LimeLightApi {
    /**
     * @param Config $config - api configuration implementation of Limelight
     */
    public function __construct(Config $config = null) {
        $config->url .= 'transact.php';
        parent::__construct($config);
    }
}