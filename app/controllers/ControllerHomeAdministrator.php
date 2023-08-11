<?php
require_once '../app/views/View.php';

class ControllerHomeAdministrator
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
        $this->_view = new View('HomeAdministrator');
        $this->_view->generate(array('users' => $users));
    }
}