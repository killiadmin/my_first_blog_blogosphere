<?php
require_once '../app/views/View.php';

class ControllerModifyPost
{
    private $_PostRepository;

    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('La page que vous souhaitez, n\'est pas disponible.');
        } else {
            $this->singlePost();
        }
    }

    private function singlePost()
    {
        if (isset($_GET['id'])) {
            $this->_PostRepository = new PostRepository();
            $post = $this->_PostRepository->getPost($_GET['id']);
            $this->_view = new View('ModifyPost');
            $this->_view->generate(array(
                'post' => $post
            ));
        }
    }
}