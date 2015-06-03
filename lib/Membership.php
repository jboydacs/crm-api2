<?php

include_once 'LimeLightApi.php';

/**
 * For pulling data from Limelight CRM
 */

class Membership extends LimeLightApi {
    /**
     * @param Config $config - api configuration implementation of Limelight
     */
    public function __construct(Config $config = null) {
        $config->url .= 'membership.php';
        parent::__construct($config);
    }
}