<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Number Helpers
 *
 * @package	CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Thanh Nguyen
 */
// ------------------------------------------------------------------------

if (!function_exists('currency_vnd')) {

    /**
     * Formats a numbers as currency
     *
     * @param	int
     * @return	string
     */
    function currency_vnd($num = 0, $ext = TRUE) {
        if($num !== '' && is_numeric($num)) {
            $num = number_format($num, "0", ",", ".");
            $num .= $ext ? " VNĐ" : '';
        }
        return $num;
    }

}

if (!function_exists('number_vn_format')) {

    /**
     * Formats a numbers as currency
     *
     * @param	int
     * @return	string
     */
    function number_vn_format($num = 0) {
        if($num != '' && is_numeric($num)) {
            $num = number_format($num, "0", ",", ".");
        }
        return $num;
    }

}

if (!function_exists('currency_dola')) {

    /**
     * Formats a numbers as currency
     *
     * @param	int
     * @return	string
     */
    function currency_dola($num = 0) {
        if($num != '' && is_numeric($num)) {
            $num = number_format($num, "2", ".", ",");
            $num = "$" . $num;
        }
        return $num;
    }

}

if (!function_exists('kbyte_format')) {

    /**
     * Formats a numbers as currency
     *
     * @param	int
     * @return	string
     */
    function kbyte_format($num = 0, $precision = 0) {
        return byte_format($num * 1024, $precision);
    }

}