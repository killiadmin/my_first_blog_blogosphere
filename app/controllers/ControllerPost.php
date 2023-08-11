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
        } elseif (isset($_GET['create'])) {
            $this->create();
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) == 'new') {
            $this->store();
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

    private function create()
    {
        if (isset($_GET['create'])) {
            $this->_view = new View('WritePost');
            $this->_view->generate(null);
        }
    }

    private function store()
    {
        $this->_postRepository = new PostRepository();
        $post = $this->_postRepository->createPost();
        $posts = $this->_postRepository->getPosts();
        $this->_view = new View('Post');
        $this->_view->generate(array('posts' => $posts));    }
}