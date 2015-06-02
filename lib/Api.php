<?php

/**
 * Api base class
 *
 *
 *
 */

abstract class Api {

    /**
     * Abstract method to be implemented by concrete classes
     *
     * @return mixed
     *
     */
    public abstract function connect();
}