<?php
include '../repository/BlogRepository.php';


class DefaultController
{
    /**
     * this function is in use, whenever the URI is empty.
     */
    public function index()
    {
        $blogRepository = new BlogRepository;
        $view = new View('default_index');
        $view->title = 'All Blogs';
        $view->heading = 'All Blogs';

        $view->blogs = $blogRepository->readAllComplete();
        $view->display();
    }
}
