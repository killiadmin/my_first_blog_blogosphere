<?php

require_once '../app/views/View.php';
class ControllerLogin
{
    private $_view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('La page que vous souhaitez, n\'est pas disponible.');
        } else {
            $this->login();
        }
    }

    private function login()
    {
            $this->_view = new View('Login');
            $this->_view->generate(null);
    }
}