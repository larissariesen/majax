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
        $view->title = 'My Profile';
        $view->heading = 'My Profile';
        $view->blogs = $blogRepository->readAllCompleteByUserID(Security::getUser()->id);
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
            $target_file = $target_dir . basename($_FILES['image_path']['tmp_name']);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


            $imageinfo = getimagesize($_FILES["image_path"]["tmp_name"]);
            $image_type = $imageinfo[2];
            $fileName = $_FILES['image_path']["name"];

            if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
                $title = htmlspecialchars($_POST['title']);
                // $user_id = $_POST['user_id'];
                $content = htmlspecialchars($_POST['content']);
                $image_path = $_FILES['image_path']["tmp_name"];

                $blogRepository = new BlogRepository();
                $insert_id = $blogRepository->create($title, Security::getUser()->id, $content, $fileName);
            }
            //TODO: move
            move_uploaded_file($image_path, $target_dir . $insert_id . $fileName);

            // Anfrage an die URI /user weiterleiten (HTTP 302)
            header('Location: /blog');
        }
    }

    public function edit()
    {
        if (isset($_GET['id']) && Security::isAuthenticated()) {
            $blog_id = $_GET['id'];

            $blogRepository = new BlogRepository();
            $blog = $blogRepository->readById($blog_id);

            if (!empty($blog) && $blog->user_id == Security::getUser()->id) {

                $view = new View('blog_edit');
                $view->blog = $blog;
                $view->title = 'Update Blog';
                $view->heading = 'Update Blog';
                $view->display();
            } else {
                header("Location: /blog");
            }
        }
        else
        {
            header("Location: /blog");
        }
    }

    public function doEdit()
    {
        if (isset($_POST["edit"])) {

            $blog_id = $_GET['id'];

            $title = $_POST['title'];
            $content = $_POST['content'];

            $blogRepository = new BlogRepository();
            $insert_id = $blogRepository->update($blog_id, $title, $content);
        }
            // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /blog');
    }

    public function delete()
    {
        $blog_id = $_POST['id'];
        $blogRepository = new BlogRepository();
        $blog = $blogRepository->readById($blog_id);


        if (isset($_POST['id'])) {
            if (($blog->user_id == Security::getUser()->email)) {
                $path = $_FILES['image_path']["name"];
            }
            if ($blogRepository->deleteById($blog_id)) {
                unlink($path);
            }
        }
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /blog');
    }
}