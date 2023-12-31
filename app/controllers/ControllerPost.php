<?php
include './app/config/config.php';

session_start();
require_once './app/views/View.php';

class ControllerPost
{
    private $_postRepository;
    private $_view;

    /**
     * Initialization of the posts part
     * @param array $url
     * @throws Exception
     */

    public function __construct(array $url)
    {
        if (isset($_SESSION['auth'], $_SESSION['user_ip'], $_SESSION['user_agent'])) {
            if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
                session_destroy();
                $msg = 'You are not authorized to access this content';
                $this->_view = new View('Login');
                $this->_view->generate(array(
                    'msg' => $msg
                ));
            } elseif (count($url) > 1){
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
        } else {
            session_destroy();
            $msg = 'You are not authorized to access this content';
            $this->_view = new View('Login');
            $this->_view->generate(array(
                'msg' => $msg
            ));
        }
    }

    /**
     * Function which allows to display the posts of the db
     * @return void
     */

    private function posts(): void
    {
        $this->_postRepository = new PostRepository();
        $posts = $this->_postRepository->getPosts();
        $this->_view = new View('Post');
        $this->_view->generate(array('posts' => $posts));
    }

    /**
     * Function which allows to display the post form for create a post
     * @return void
     */

    private function create(): void
    {
        if (isset($_GET['create']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            $this->_view = new View('WritePost');
            $this->_view->generate((array)null);
        } else {
            $msg = 'You are not allowed to write an article !';
            $this->_view = new View('Login');
            $this->_view->generate(array('msg' => $msg));
        }
    }

    /**
     * Function which allows to display the page update post to edit the content
     * @return void
     */

    private function modify(): void
    {
        if (isset($_GET['modify'], $_GET['id'])) {
            $this->_postRepository = new PostRepository();
            $post = $this->_postRepository->getPost($_GET['id']);
            $this->_view = new View('ModifyPost');
            $this->_view->generate(array('post' => $post));
        }
    }

    /**
     * Function which allows to create the post to insert the content
     * @return void
     */

    private function store(): void
    {
        if ($_POST['csrf_token'] == $_SESSION['csrf_token']){
            $this->_postRepository = new PostRepository();
            $post = $this->_postRepository->createPost();
            $posts = $this->_postRepository->getPosts();
            $this->_view = new View('Post');
            $this->_view->generate(array('posts' => $posts));
        }
    }

    /**
     * Function which allows to delete the post
     * @return void
     */

    private function delete(): void
    {
        if ($_POST['csrf_token'] == $_SESSION['csrf_token']){
            $this->_postRepository = new PostRepository();
            $this->_postRepository->deletePost($_GET['postToDelete']);
            $posts = $this->_postRepository->getPosts();
            $this->_view = new View('Post');
            $this->_view->generate(array('posts' => $posts));
        }
    }
}