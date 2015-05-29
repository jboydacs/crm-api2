<?php

include_once 'Config.php';

class LimeLightConfig extends Config {

    public function __construct($user = null, $url = null, $key = null) {
        parent::__construct($user, $url, $key);
    }
}