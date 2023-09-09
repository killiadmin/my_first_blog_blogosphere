<?php
include './app/config/config.php';

session_start();
require_once './app/views/View.php';

class ControllerSinglepost
{
    private $_PostRepository;
    private $_CommentRepository;

    private $_view;

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
            } elseif (count($url) < 1){
                throw new \Exception('The page you want is not available.');
            } elseif (isset($_GET['status']) && $_GET['status'] === 'comment') {
                $this->comments();
            } elseif (isset($_GET['validateComment'])) {
                $this->validateComment();
            } elseif (isset($_GET['status']) && $_GET['status'] === 'update') {
                $this->updatePost();
            } else {
                $this->singlePost();
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

    private function singlePost(): void
    {
        if (isset($_GET['id'])) {
            $this->_PostRepository = new PostRepository();
            $this->_CommentRepository = new CommentRepository();
            $post = $this->_PostRepository->getPost($_GET['id']);
            $comment = $this->_CommentRepository->getComment($_GET['id']);
            $this->_view = new View('Singlepost');
            $this->_view->generate(array(
                'post' => $post,
                'comment' => $comment
            ));
        }
    }

    private function updatePost(): void
    {
        if (isset($_GET['id']) && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
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
            $this->_view = new View('Singlepost');
            $this->_view->generate(array(
                'post' => $post,
                'comment' => $comment
            ));
        }
    }

    /**
     * Method for validating a user's comment
     * @return void
     * @throws Exception
     */
    private function validateComment(): void
    {
        if (isset($_GET['id']) && $_SESSION['role'] === 'admin') {
            $this->_commentRepository = new CommentRepository();
            $this->_commentRepository->validateComment($_GET['id']);

            $this->_postRepository = new PostRepository();
            $posts = $this->_postRepository->getPosts();

            $this->_userRepository = new UserRepository();
            $users = $this->_userRepository->getUsers();

            $comments = $this->_commentRepository->getComments();

            $this->_view = new View('Homeadministrator');
            $this->_view->generate(array(
                'users' => $users,
                'posts' => $posts,
                'comments' => $comments
            ));
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var commentsSection = document.getElementById("validateComments");
                    if (commentsSection) {
                        commentsSection.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            </script>
            <?php
        } else {
            $msg = 'You are not authorized to access this page !';
            $this->_view = new View('Login');
            $this->_view->generate(array(
                'msg' => $msg
            ));
        }
}

    private function comments(): void
    {
        if (isset($_GET['id']) && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            $this->_PostRepository = new PostRepository();
            $this->_CommentRepository = new CommentRepository();
            $this->_CommentRepository->createComment($_GET['id'], $_SESSION['id']);
            $comment = $this->_CommentRepository->getComment($_GET['id']);

            $msg = 'Your comment has been sent, it will be validated soon.';
            $post = $this->_PostRepository->getPost($_GET['id']);
            $this->_view = new View('Singlepost');
            $this->_view->generate(array(
                'post' => $post,
                'comment' => $comment,
                'msg' => $msg
            ));
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var commentsSection = document.getElementById("comments");
                    if (commentsSection) {
                        commentsSection.scrollIntoView({ behavior: 'smooth' });
                }
                });
            </script>
            <?php
        }
    }
}