<?php

include_once 'CRMApi.php';
include_once 'Config.php';

class Orange extends CRMApi {
    /**
     * @var
     */
    private $config;

    /**
     * @var
     */
    private $requestData;

    /**
     * @param Config $config - api configuration implementation of Limelight
     */
    public function __construct(Config $config = null) {
        $this->config = $config;
    }

    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }

    /**
     * @return mixed
     * @throws FailedToConnectException
     * @throws RequestMethodNotFoundException
     */
    public function connect() {

        return null;
    }
}