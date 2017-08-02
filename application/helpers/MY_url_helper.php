<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('init_url')) {

    /**
     * build param url
     *
     * @param	path, params
     * @return	string url
     */
    function init_url($path = '/', $params = array()) {
        if(isset($params['per_page'])) {
            unset ($params['per_page']);
        }
        if(isset($params['page'])) {
            unset ($params['page']);
        }
        if(isset($params['trang'])) {
            unset ($params['trang']);
        }
        if(isset($params['submit'])) {
            unset ($params['submit']);
        }
        if(isset($params['ci_csrf_token'])) {
            unset ($params['ci_csrf_token']);
        }
        return base_url($path.'?'.http_build_query($params));
    }

}