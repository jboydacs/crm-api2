<?php

/**
 * Class Api - base class of all api classes
 *
 */

abstract class Api {

    /**
     * @return mixed
     * Abstract method to be implemented by concrete classes
     */
    public abstract function connect();
}