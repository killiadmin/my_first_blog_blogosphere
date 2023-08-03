<?php

class ControllerHome
{
    private $_userRepository;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Notfound Page', 1);
        } else {
            $this->users();
        }
    }

    private function users()
    {
        $this->_userRepository = new UserRepository();
        $users = $this->_userRepository->getUsers();
        require_once '../app/views/HomeView.php';
    }
}