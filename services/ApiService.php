<?php

include_once 'CrmService.php';

/**
 * Will be implemented by all API services
 */

interface ApiService extends CrmService {
    /**
     * @return mixed - for connecting to API
     */
    public function connect();
}