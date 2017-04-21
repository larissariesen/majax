<?php

/**
 * Created by PhpStorm.
 * User: briesl
 * Date: 18.04.2017
 * Time: 16:56
 */
class Security
{
    const SESSION_USER = "USER";


    /**
     * check if user is logged in
     * @return bool
     */
    public static function isAuthenticated() {

        return isset($_SESSION[Security::SESSION_USER]) && $_SESSION[Security::SESSION_USER]->id > 0;

    }

    /**
     * return the current logged in user
     * @return mixed
     */
    public static function getUser() {
        return isset($_SESSION[Security::SESSION_USER]) ? $_SESSION[Security::SESSION_USER] : NULL;
    }


}