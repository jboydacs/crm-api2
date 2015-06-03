<?php


/**
 * For posting data to Limelight CRM
 */

class Transaction extends LimeLightApi {
    /**
     * @param Config $config - api configuration implementation of Limelight
     */
    public function __construct(Config $config = null) {
        $config->url .= 'transaction.php';
        parent::__construct($config);
    }
}