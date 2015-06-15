<?php

function apiMethodToCamelCase($method) {
    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $method)));
    return lcfirst($str);
}