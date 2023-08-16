<?php
require_once '../app/views/View.php';

class ControllerSinglePost
{
    private $_PostRepository;
    private $_CommentRepository;

    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('La page que vous souhaitez, n\'est pas disponible.');
        } elseif (isset($_GET['status']) && $_GET['status'] === 'comment'){
            $this->comments();
        } else {
            $this->singlePost();
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

    private function comments()
    {
        if (isset($_GET['id'])) {
            $this->_PostRepository = new PostRepository();
            $this->_CommentRepository = new CommentRepository();
            $creatComment = $this->_CommentRepository->createComment($_GET['id']);
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