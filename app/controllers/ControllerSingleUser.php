<?php
session_start();

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
        } elseif (isset($_GET['status']) && $_GET['status'] === 'login'){
            $this->connection();
        } else {
            $this->user();
        }
    }

    /**
     * Method to generate the view of a user if it exists with its data assigned to it
     * @return void
     */
    private function user()
    {
        if (isset($_GET['id'])) {
            $this->_userRepository = new UserRepository();
            $user = $this->_userRepository->getUser($_GET['id']);
            $this->_view = new View('SingleUser');
            $this->_view->generate(array('user' => $user));
        }
    }

    /**
     * Method to connect to the application which checks the entry of the email and the password entered
     * by the user and which feeds the user's session
     * @return void
     */
    private function connection()
    {
        if (isset($_GET['id'])) {
            if (!empty($_POST['mail']) && !empty($_POST['password'])) {

                $user_mail = htmlspecialchars($_POST["mail"]);
                $user_password = htmlspecialchars($_POST["password"]);

                $this->_userRepository = new UserRepository();

                $userInfos = $this->_userRepository->connection($user_mail, $user_password);

                if (!empty($userInfos)) {

                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                    }

                    $_SESSION['auth'] = true;
                    $_SESSION['role'] = $userInfos[0]->status();
                    $_SESSION['id'] = $userInfos[0]->idUser();
                    $_SESSION['username'] = $userInfos[0]->username();
                    $_SESSION['name'] = $userInfos[0]->name();
                    $_SESSION['quote'] = $userInfos[0]->quote();

                    $user = $this->_userRepository->getUser($_GET['id']);

                    $this->_view = new View('SingleUser');
                    $this->_view->generate(array('user' => $user));
                } else {
                    $msg = 'Vos identifiants sont incorrects.';
                    $this->_view = new View('Login');
                    $this->_view->generate(array('msg' => $msg));
                }
            }

        }
    }

    /**
     * Method that uses the MailJet package to send an email with the contact form
     * that will generate the view of the homepage after sending it.
     * @return void
     */
    private function sendemail()
{
        if (isset($_GET['id'])) {

            require_once '../vendor/mailjet/mailjet-apiv3-php/src/Mailjet/Resources.php';

            define('API_USER', 'a847669765140ba252eb1743c9b29396');
            define('API_LOGIN', 'abf1c232ed1081bfb6def81e6a8850c1');

            $mj = new \Mailjet\Client(API_USER,API_LOGIN,true,['version' => 'v3.1']);

            if (isset($_POST['mailForm'])) {
                $name = htmlspecialchars($_POST['name']);
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['mail']);
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