<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 5/29/15
 * Time: 11:13 PM
 */

include_once 'Config.php';

class LimeLightConfig extends Config {

    public function __construct($user = null, $url = null, $key = null) {
        parent::__construct($user, $url, $key);
    }
}