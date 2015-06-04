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

    /**
     * @return mixed
     */
    public function orderView();

    /**
     * @return mixed
     */
    public function prospectFind();

    /**
     * @return mixed
     */
    public function prospectView();
}