<?php

/**
 * @param $action
 * @return string - camel case of action/method
 */
function apiMethodToCamelCase($method) {
    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $method)));
    return lcfirst($str);
}