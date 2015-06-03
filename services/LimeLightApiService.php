<?php

include_once 'ApiService.php';

interface LimeLightApiService extends ApiService {
    /**
     * @param $action
     * @return mixed
     */
    public function prettify();

    /**
     * @return mixed
     */
    public function orderFind();
}