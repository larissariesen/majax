<?php

require_once 'UserRepository.php';

/**
 * @author briesl, bpellm
 * Date: 19.04.2017
 * Time: 09:44
 */
class BlogRepository extends Repository
{
    protected $tableName = 'blogs';

    /**
     * Creates blog with inputs by User
     *
     * @param $title
     * @param $user_id
     * @param $content
     * @param $image_path
     * @return mixed
     * @throws Exception
     */
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

    /**
     * Takes out every Blog from Database and orders them by id Descending.
     *
     * @return array
     * @throws Exception
     */
    public function readAllComplete()
    {
        $query = "SELECT * FROM {$this->tableName} ORDER BY id DESC";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Saves $rows as array from Result
        $rows = array();
        $userRepository = new UserRepository();

        while ($row = $result->fetch_object()) {

            $user = $userRepository->readById($row->user_id);
            $row->user = $user;

            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Gives every Blog created by User WHERE user_id=?
     *
     * @param $user_id
     * @return array
     * @throws Exception
     */
    public function readAllCompleteByUserID($user_id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE user_id=? ORDER BY id DESC";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $user_id);
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

    /**
     * Makes it possible to edit your own blogs.
     *
     * @param $blog_id
     * @param $title
     * @param $content
     * @throws Exception
     */
    public function update($blog_id, $title, $content)
    {
        $query = "UPDATE {$this->tableName} SET title=?, content=? WHERE id=?";

        $blogRepository = new BlogRepository();
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssi', $title, $content, $blog_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

    }
}
