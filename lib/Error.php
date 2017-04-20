<?php

/**
 * Created by PhpStorm.
 * User: bpellm
 * Date: 20.04.2017
 * Time: 10:52
 */
class Error
{
    private static $errors = [];

    public static function add($key, $value) {
        Error::$errors[$key] = $value;
    }

    public static function get($key) {
        return (isset(Error::$errors[$key])) ? Error::$errors[$key] : "";
    }

}