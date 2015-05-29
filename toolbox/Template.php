<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 5/27/15
 * Time: 10:54 PM
 */

class Template {

    public function __construct() {
    }
    public function __destruct() {
    }
    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }
    public function __toString() {
        return 'string';
    }
}