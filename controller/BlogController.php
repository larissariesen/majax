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
        if ($_POST['send']) {
            $title = $_POST['title'];
           // $user_id = $_POST['user_id'];
            $content = $_POST['content'];
            $image_path = $_POST['image_path'];

            $blogRepository = new BlogRepository();
            $blogRepository->create($title, Security::getUser()->id, $content, $image_path);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /blog');
    }

}