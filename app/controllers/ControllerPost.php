<?php
session_start();
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
        } elseif (isset($_GET['modify'])) {
            $this->modify();
        } elseif (isset($_GET['status']) && $_GET['status'] === 'new') {
            $this->store();
        } elseif (isset($_GET['status']) && $_GET['status'] === 'delete') {
            $this->delete();
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
        if (isset($_GET['create']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $this->_view = new View('WritePost');
            $this->_view->generate(null);
        } else {
            $msg = 'Vous n\'êtes pas autorisé à écrire un article !';
            $this->_view = new View('Login');
            $this->_view->generate(array('msg' => $msg));
        }
    }

    private function modify()
    {
        if (isset($_GET['modify'], $_GET['id'])) {
            $this->_postRepository = new PostRepository();
            $post = $this->_postRepository->getPost($_GET['id']);
            $this->_view = new View('ModifyPost');
            $this->_view->generate(array('post' => $post));
        }
    }

    private function store()
    {
        $this->_postRepository = new PostRepository();
        $post = $this->_postRepository->createPost();
        $posts = $this->_postRepository->getPosts();
        $this->_view = new View('Post');
        $this->_view->generate(array('posts' => $posts));
    }

    private function delete()
    {
        $this->_postRepository = new PostRepository();
        $deletePost = $this->_postRepository->deletePost($_GET['postToDelete']);
        $posts = $this->_postRepository->getPosts();
        $this->_view = new View('Post');
        $this->_view->generate(array('posts' => $posts));
    }
}