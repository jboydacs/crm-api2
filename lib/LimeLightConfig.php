<?php

include_once 'Config.php';

/**
 * Class LimeLightConfig - concrete configuration for LimeLight API CRM
 */

class LimeLightConfig extends Config {

    /**
     * @param null $user
     * @param null $url
     * @param null $key
     */
    public function __construct($user, $url, $key) {
        parent::__construct($user, $url, $key);
    }

    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }
}