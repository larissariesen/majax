<?php

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

        $view = new View('user_index');
        $view->title = 'Blogs';
        $view->heading = 'Blogs';
        $view->blogs = $blogRepository->readAll();
        $view->display();
    }

}