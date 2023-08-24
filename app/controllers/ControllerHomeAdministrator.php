<?php
session_start();

require_once '../app/views/View.php';

class ControllerHomeAdministrator
{
    private  $_commentRepository;
    private $_postRepository;
    private $_userRepository;
    private $_view;

    public function __construct($url)
    {
        if (isset($_SESSION['auth']) && $_SESSION['role'] === 'admin') {
            if (isset($url) && count($url) > 1) {
                throw new \Exception('Notfound Page', 1);
            } else {
                $this->contentsAdmin();
            }
        } else {
            $msg = 'You are not authorized to access this content';
            $this->_view = new View('Login');
            $this->_view->generate(array(
                'msg' => $msg
            ));
        }
    }

    private function contentsAdmin()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
            $this->_postRepository = new PostRepository();
            $posts = $this->_postRepository->getPosts();

            $this->_userRepository = new UserRepository();
            $users = $this->_userRepository->getUsers();

            $this->_commentRepository = new CommentRepository();
            $comments = $this->_commentRepository->getComments();

            $this->_view = new View('HomeAdministrator');
            $this->_view->generate(array(
                'users' => $users,
                'posts' => $posts,
                'comments' => $comments
            ));
        } else {
            $msg = 'Vous n\'êtes pas autorisé à accéder à cette page !';
            $this->_view = new View('Login');
            $this->_view->generate(array(
                'msg' => $msg
            ));
        }
    }
}