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


    public static function isAuthenticated() {

        return isset($_SESSION[Security::SESSION_USER]) && $_SESSION[Security::SESSION_USER]->id > 0;

    }


}