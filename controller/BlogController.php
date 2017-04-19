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
        $target_dir = "uploads/";
        $imageFileType = pathinfo($_FILES["image_path"]["name"], PATHINFO_EXTENSION);
        //check if file is an actual image
        if (isset($_POST["send"])) {
            $check = getimagesize($_FILES["image_path"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            //move
            $title = $_POST['title'];
            $content = $_POST['content'];


            $blogRepository = new BlogRepository();
            $id = $blogRepository->create($title, Security::getUser()->id, $content, "");

            $dstFileName = $target_dir.$id.".".$imageFileType;

            if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $dstFileName)) {

                $blogRepository->updateImagePath($id, $dstFileName);

            }

        }
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /blog');
    }
}