<?php

/**
 * Created by PhpStorm.
 * User: bpellm
 * Date: 21.04.2017
 * Time: 11:34
 */
class Success{


    public static function add($key, $value) {
        $_SESSION[$key] = $value;
    }

    /*public static function get($key) {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : "";
    }*/
}