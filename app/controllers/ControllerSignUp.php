<?php
session_start();
require_once './app/views/View.php';
class ControllerSignup
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('The page you want is not available.');
        } else {
            $this->signup();
        }
    }

    private function signup()
    {
        if (isset($_SESSION) && $_SESSION) {
            $_SESSION = [];

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        }

        $this->_view = new View('Signup');
        $this->_view->generate(null);
    }
}