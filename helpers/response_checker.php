<?php

/**
 * @param $data
 * @return bool
 * Check if the api call successfully reached the server
 */
function didNotReachedServer($data) {
    return !(array_key_exists('response_code', $data) || array_key_exists('responseCode', $data));
}

/**
 * @param $data
 * @return bool
 * Check if Limelight api call is ok. 100 response code means success
 */
function isRequestSuccessful($data) {
    return  is_array($data) && ($data['response_code'] === '100' || $data['responseCode'] === '100');
}

/**
 * @param $data
 * @return bool
 * Check if api response has errors
 */
function isParsedDataHasErrors($data) {
    return array_key_exists('error_message', $data);
}

/**
 * @return bool - check if api parameters includes method field
 */
function hasRequestMethod($data) {
    return array_key_exists('method', $data);
}