<?php

require_once '../lib/Repository.php';

/*
 * UserRepository Handel the access to to table 'user' *
*/

class UserRepository extends Repository
{

    protected $tableName = 'user';

    /**
     *Creat new User with entered values
     *password is hashed
     *
     * @throws Exception if $statment throws back error
     */
    public function create($firstName, $lastName, $email, $password)
    {
        $password = hash('sha256', $password);

        $query = "INSERT INTO $this->tableName (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $firstName, $lastName, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function readByEmail($email)
    {
        // create Query
        $query = "SELECT * FROM {$this->tableName} WHERE email=?";
        //request DatabaseConnection
        // prepare Query & bind parameters
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);
        // execute (ausführen) the $statement
        $statement->execute();
        // get Result of the request
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        // get first record
        $row = $result->fetch_object();
        // release the Database resources again
        $result->close();
        // give back found record
        return $row;
    }
}
