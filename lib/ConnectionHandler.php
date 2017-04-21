<?php

/**
 * The Connectionhandler connects every repository with the same database.
 */
class ConnectionHandler
{
    /**
     * Makes it possible not having to make a new connection with every SQL query.
     */
    private static $connection = null;

    /**
     * check databaseconnection when not exists initialize on and retrun ir
     *
     * @throws Exception for connection error
     *
     * @return MySQLi connection for access  to the database
     */
    public static function getConnection()
    {
        // check if connection alreay exists
        if (self::$connection === null) {

            //Read configuration file
            $config = require '../config.php';
            $host = $config['database']['host'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];
            $database = $config['database']['database'];

            // initialize connection
            self::$connection = new MySQLi($host, $username, $password, $database);
            if (self::$connection->connect_error) {
                $error = self::$connection->connect_error;
                throw new Exception("Verbindungsfehler: $error");
            }

            self::$connection->set_charset('utf8');
        }

        // return connection
        return self::$connection;
    }
}
