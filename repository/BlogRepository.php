<?php

require_once 'UserRepository.php';

/**
 * Created by PhpStorm.
 * User: briesl
 * Date: 19.04.2017
 * Time: 09:44
 */
class BlogRepository extends Repository
{
protected $tableName = 'blogs';

    public function create($title, $user_id, $content, $image_path)
    {

        $query = "INSERT INTO $this->tableName (title, user_id, content, image_path) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('siss', $title, $user_id, $content, $image_path);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function readAllComplete($max = 100)
    {
        $query = "SELECT * FROM {$this->tableName} LIMIT 0, $max";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        $userRepository = new UserRepository();

        while ($row = $result->fetch_object()) {

            $user = $userRepository->readById($row->user_id);
            $row->user = $user;

            $rows[] = $row;
        }

        return $rows;
    }

}

