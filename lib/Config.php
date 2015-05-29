<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 5/27/15
 * Time: 10:25 PM
 */

class Config {

    protected $user;
    protected $url;
    protected $key;

    public function __construct($user = null, $url = null, $key = null) {
        $this->user = $user;
        $this->url = $url;
        $this->key = $key;
    }

    public function __get($prop) {
        return $this->{$prop};
    }

    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }
}