<?php
require_once '../app/views/View.php';

class ControllerPost
{
    private $_postRepository;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Notfound Page', 1);
        } elseif ($_GET('create') !== null) {
            $this->create();
        } else {
            $this->posts();
        }
    }

    //Function which allows to display the posts of the db
    private function posts()
    {
        $this->_postRepository = new PostRepository();
        $posts = $this->_postRepository->getPosts();
        $this->_view = new View('Post');
        $this->_view->generate(array('posts' => $posts));
    }
}