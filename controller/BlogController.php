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
    /**
     * Makes View for Blog_index
     */
    public function index()
    {
        if (Security::isAuthenticated()){
            $blogRepository = new BlogRepository();

            $view = new View('blog_index');
            $view->title = 'My Profile';
            $view->heading = 'My Profile';
            $view->blogs = $blogRepository->readAllCompleteByUserID(Security::getUser()->id);
            $view->display();
        }
        else{
            header("Location: /");
        }

    }

    /**
     * view of creating a blog
     */
    public function create()
    {
        if(!Security::isAuthenticated())
        {
            header("Location: /");
            exit();
        }
        $this->doCreate();

        $view = new View('blog_create');
        $view->title = 'Create Blog';
        $view->heading = 'Create Blog';
        $view->display();
    }

    /**
     * Creates Blog
     */
    public function doCreate()
    {
        //Upload Image

        //check if file is an actual image
        if (isset($_POST["send"])) {
            if (empty($_POST['title'])) {
                Error::add("title_empty", "Please enter a title");
                return;
            }
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $image_path = null;

            if (!empty($_FILES["image_path"]['tmp_name'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES['image_path']['tmp_name']);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                $imageinfo = getimagesize($_FILES["image_path"]["tmp_name"]);
                $image_type = $imageinfo[2];
                $fileName = $_FILES['image_path']["name"];
                if (!in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
                    Error::add("not_image", "please upload image file.");
                    return;
                }
                else {
                    $image_path = $_FILES['image_path']["tmp_name"];
                }
            }
            $blogRepository = new BlogRepository();
            $insert_id = $blogRepository->create($title, Security::getUser()->id, $content, $fileName);
            if ($image_path != NULL) {
                move_uploaded_file($image_path, $target_dir . $insert_id . $fileName);
            }
            // Anfrage an die URI /user weiterleiten (HTTP 302)
            Success::add("blog_created", "Successfully created blog");
            header('Location: /blog');

        }
    }

    /**
     * Makes it possible to edit your Blogs. You can Edit everything but the picture.
     */
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
        } else {
            header("Location: /blog");
        }
    }

    /**
     * saves new Values into Blog
     */
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

    /**
     * Makes it possible to delete only your own blogs.
     */
    public function delete()
    {
        if (isset($_GET['id']) && Security::isAuthenticated()) {
            $blog_id = $_GET['id'];
            $blogRepository = new BlogRepository();
            $blog = $blogRepository->readById($blog_id);

            if (!empty($blog) && $blog->user_id == Security::getUser()->id) {

                if (isset($_GET['id'])) {
                    if (($blog->user_id == Security::getUser()->email)) {
                        $path = $_FILES['image_path']["name"];
                    }
                    if ($blogRepository->deleteById($blog_id)) {
                        unlink($path);
                    }
                }
            }
        }
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /blog');
    }
}