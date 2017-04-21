<?php

/**
 * Created by PhpStorm.
 * User: bpellm
 * Date: 21.04.2017
 * Time: 11:34
 */
class Success{


    public static function add($key, $value) {
        $_SESSION['success'][$key] = $value;
    }

    public static function get($key) {
        $msg = "";
        if (isset($_SESSION['success'][$key])) {
            $msg = $_SESSION['success'][$key];

            unset($_SESSION['success'][$key]);
        }

        return $msg;
    }

    public static function hasSuccess() {
        return !empty($_SESSION['success']) && count($_SESSION['success']) > 0;
    }
}