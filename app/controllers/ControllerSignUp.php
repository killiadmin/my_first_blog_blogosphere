<?php

require_once '../app/views/View.php';
class ControllerSignUp
{
    private $_view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('La page que vous souhaitez, n\'est pas disponible.');
        } else {
            $this->signup();
        }
    }

    private function signup()
    {
        $this->_view = new View('SignUp');
        $this->_view->generate(null);
    }
}