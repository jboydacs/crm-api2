<?php

include_once 'Config.php';


class OrangeConfig extends Config {

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