<?php

abstract class Api {
    private $config;

    public function __construct($config = null) {
        $this->config = $config;
    }

    public abstract function connect($data);
}