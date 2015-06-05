<?php

require_once 'Api.php';

abstract class CRMApi implements Api {
    /**
     * Abstract method to be implemented by concrete classes
     *
     * @return mixed
     *
     */
    public abstract function connect();
}