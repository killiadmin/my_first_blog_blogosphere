<?php

require_once '../app/views/View.php';
class ControllerSingleUser
{
    private $_userRepository;
    private $_view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('La page que vous souhaitez, n\'est pas disponible.');
        } else {
            $this->user();
        }
    }

    private function user()
    {
        if (isset($_GET['id'])) {
            $this->_userRepository = new UserRepository();
            $user = $this->_userRepository->getUser($_GET['id']);
            $this->_view = new View('SingleUser');
            $this->_view->generate(array('user' => $user));
        }
    }
}