<?php
session_start();
require_once './app/views/View.php';
class ControllerLogin
{
    private $_view;

    private $_title;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('The page you want is not available.');
        } else {
            $this->login();
        }
    }

    private function login()
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

        $this->_title = 'Login';
        $this->_view = new View('Login');
        $this->_view->generate(null);

    }
}