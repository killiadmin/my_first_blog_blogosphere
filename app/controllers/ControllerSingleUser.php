<?php

use Mailjet\Resources;

require_once '../app/views/View.php';
class ControllerSingleUser
{
    private $_userRepository;
    private $_view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('La page que vous souhaitez, n\'est pas disponible.');
        } elseif (isset($_GET['status']) && $_GET['status'] === 'sendemail'){
            $this->sendemail();
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

    private function sendemail(){
        if (isset($_GET['id'])) {

            require_once '../vendor/mailjet/mailjet-apiv3-php/src/Mailjet/Resources.php';

            define('API_USER', 'a847669765140ba252eb1743c9b29396');
            define('API_LOGIN', 'abf1c232ed1081bfb6def81e6a8850c1');

            $mj = new \Mailjet\Client(API_USER,API_LOGIN,true,['version' => 'v3.1']);

            if (isset($_POST['mailForm'])) {
                $name = htmlspecialchars($_POST['name']);
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $message = htmlspecialchars($_POST['message']);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $body = [
                        'Messages' => [
                            [
                                'From' => [
                                    'Email' => $email,
                                    'Name' => "Me"
                                ],
                                'To' => [
                                    [
                                        'Email' => "support@chaletsetcaviar.killianfilatre.fr",
                                        'Name' => "You"
                                    ]
                                ],
                                'Subject' => "My first Mailjet Email!",
                                'TextPart' => "De $name $username, Contenu du mail : $message",
                            ]
                        ]
                    ];

                    $response = $mj->post(Resources::$Email, ['body' => $body]);
                    $response->success();
                }
            }

            $this->_userRepository = new UserRepository();
            $user = $this->_userRepository->getUser($_GET['id']);
            $this->_view = new View('SingleUser');
            $this->_view->generate(array('user' => $user));
        }
    }
}