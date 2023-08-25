<?php
session_start();
require_once '../app/views/View.php';

class ControllerSinglePost
{
    private $_PostRepository;
    private $_CommentRepository;

    private $_view;

    public function __construct($url)
    {
        if (isset($_SESSION['auth'])) {
            if (isset($url) && count($url) < 1) {
                throw new \Exception('The page you want is not available.');
            }

            if (isset($_GET['status']) && $_GET['status'] === 'comment') {
                $this->comments();
            } elseif (isset($_GET['status']) && $_GET['status'] === 'update') {
                $this->updatePost();
            } else {
                $this->singlePost();
            }
        } else {
            $msg = 'You are not authorized to access this content';
            $this->_view = new View('Login');
            $this->_view->generate(array(
                'msg' => $msg
            ));
        }
    }

    private function singlePost()
    {
        if (isset($_GET['id'])) {
            $this->_PostRepository = new PostRepository();
            $this->_CommentRepository = new CommentRepository();
            $post = $this->_PostRepository->getPost($_GET['id']);
            $comment = $this->_CommentRepository->getComment($_GET['id']);
            $this->_view = new View('SinglePost');
            $this->_view->generate(array(
                'post' => $post,
                'comment' => $comment
            ));
        }
    }

    private function updatePost()
    {
        if (isset($_GET['id'])) {
            $this->_PostRepository = new PostRepository();
            $this->_CommentRepository = new CommentRepository();
            $postUpdate = $this->_PostRepository->updatePost($_GET['id']);
            $post = $this->_PostRepository->getPost($_GET['id']);

            if(isset($postUpdate) && $postUpdate[0] == 'erreurStatus'){
                $msg = 'The user does not exist !';
                $this->_view = new View('ModifyPost');
                $this->_view->generate(array(
                    'post' => $post,
                    'msg' => $msg
                ));
                return;
            }

            $comment = $this->_CommentRepository->getComment($_GET['id']);
            $this->_view = new View('SinglePost');
            $this->_view->generate(array(
                'post' => $post,
                'comment' => $comment
            ));
        }
    }

    private function comments()
    {
        if (isset($_GET['id'])) {
            $this->_PostRepository = new PostRepository();
            $this->_CommentRepository = new CommentRepository();
            $this->_CommentRepository->createComment($_GET['id'], $_SESSION['id']);
            $comment = $this->_CommentRepository->getComment($_GET['id']);
            $post = $this->_PostRepository->getPost($_GET['id']);
            $this->_view = new View('SinglePost');
            $this->_view->generate(array(
                'post' => $post,
                'comment' => $comment
            ));
        }
    }
}