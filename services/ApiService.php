<?php

/**
 * Will be implemented by all API services
 */

interface ApiService {
    /**
     * @return mixed - for connecting to API
     */
    public function connect();
}