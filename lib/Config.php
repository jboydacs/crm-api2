<?php

/**
 * Class Config - holds the basic configuration/credentials of API classes. Must to be extended
 */
class Config {

    /**
     * @var null
     */
    protected $user;

    /**
     * @var
     */
    protected $url;
    /**
     * @var
     */
    protected $key;

    /**
     * @param null $user
     * @param null $url
     * @param null $key
     */
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