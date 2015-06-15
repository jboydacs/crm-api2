<?php

require_once 'API.php';
require_once 'Orange.php';
require_once 'Konnektive.php';
require_once 'Limelight.php';

class CRM implements API
{
    private $user;
    private $password;
    private $key;
    private $crm;

    public function __construct($user, $password, $key, $crm)
    {
        $this->user = $user;
        $this->password = $password;
        $this->key = $key;
        $this->crm = $crm;
    }

    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }

    public function __destruct() {}

    function connect()
    {
        $response = null;
        try
        {
            switch ($this->crm)
            {
                case 'orange':
                    $response = Orange::method($this->method, $this->requestData);
                    break;
                case 'konnektive':
                    break;
                case 'limelight':
                    $response = Limelight::method($this->method, $this->requestData);
                    break;
            }
        }
        catch (Exception $dx)
        {
            return $dx->getMessage();
        }
        return $response;
    }
}