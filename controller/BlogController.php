<?php

require_once '../repository/BlogRepository.php';

/**
 * Created by PhpStorm.
 * User: briesl
 * Date: 18.04.2017
 * Time: 15:05
 */
class BlogController
{
    public function index()
    {
        $blogRepository = new BlogRepository();

        $view = new View('blog_index');
        $view->title = 'Blogs';
        $view->heading = 'Blogs';
        $view->blogs = $blogRepository->readAllComplete();
        $view->display();
    }

    public function create()
    {
        $view = new View('blog_create');
        $view->title = 'Create Blog';
        $view->heading = 'Create Blog';
        $view->display();
    }
    public function doCreate()
    {
        //Upload Image

        //check if file is an actual image
        if (isset($_POST["send"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir.basename($_FILES['image_path']['tmp_name']);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $check = getimagesize($_FILES["image_path"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            //move
            

            if ($_POST['send']) {
                $title = htmlspecialchars($_POST['title']);
                // $user_id = $_POST['user_id'];
                $content = htmlspecialchars($_POST['content']);
                $image_path = $_POST['image_path'];

                $blogRepository = new BlogRepository();
                $blogRepository->create($title, Security::getUser()->id, $content, $image_path);
            }

            // Anfrage an die URI /user weiterleiten (HTTP 302)
            header('Location: /blog');
        }
    }
}