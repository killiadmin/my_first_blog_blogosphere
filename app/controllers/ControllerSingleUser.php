<?php
include './app/config/config.php';

session_start();

$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

use Mailjet\Resources;
require_once './app/views/View.php';
class ControllerSingleuser
{
    private $_userRepository;
    private $_view;

    public function __construct(array $url)
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('The page you want is not available.');
        }

        if (isset($_GET['status']) && $_GET['status'] === 'login') {
            $this->connectionUser();
        } elseif (isset($_GET['status']) && $_GET['status'] === 'signup') {
            $this->signUpUser();
        } elseif (isset($_SESSION['auth'], $_SESSION['user_ip'], $_SESSION['user_agent'])){
            if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] || $_SESSION['auth'] !== true) {
                session_destroy();
                $msg = 'You are not authorized to access this content';
                $this->_view = new View('Login');
                $this->_view->generate(array(
                    'msg' => $msg
                ));
            } elseif (isset($_GET['status'], $_SESSION['auth']) && $_GET['status'] === 'sendemail') {
                $this->sendEmail();
            } else {
                $this->user();
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

    /**
     * Method to generate the view of a user if it exists with its data assigned to it
     * @return void
     */
    private function user()
    {
        if (isset($_GET['id'])) {
            $this->_userRepository = new UserRepository();
            $user = $this->_userRepository->getUser($_GET['id']);
            $this->_view = new View('Singleuser');
            $this->_view->generate(array('user' => $user));
        }
    }

    /**
     * Method to connect to the application which checks the entry of the email and the password entered
     * by the user and which feeds the user's session
     * @return void
     */
    private function connectionUser()
    {
        if (isset($_GET['id'])) {
            if (!empty($_POST['mail']) && !empty($_POST['password'])) {

                $user_mail = htmlspecialchars($_POST["mail"]);
                $user_password = htmlspecialchars($_POST["password"]);

                $this->_userRepository = new UserRepository();

                $userInfos = $this->_userRepository->connection($user_mail, $user_password);

                if (!empty($userInfos)) {

                    // Vérification d'IP et d'agent utilisateur
                    if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
                        session_destroy();
                    }

                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    }

                    // Génération aléatoire d'identifiants de session
                    session_regenerate_id(true);

                    if (!isset($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }

                    $_SESSION['auth'] = true;
                    $_SESSION['role'] = $userInfos[0]->status();
                    $_SESSION['id'] = $userInfos[0]->idUser();
                    $_SESSION['username'] = $userInfos[0]->username();
                    $_SESSION['name'] = $userInfos[0]->name();
                    $_SESSION['quote'] = $userInfos[0]->quote();

                    if (isset($_SESSION['user_ip'], $_SESSION['user_agent']) &&
                        $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR'] &&
                        $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {

                        $user = $this->_userRepository->getUser($_GET['id']);

                        $this->_view = new View('Singleuser');
                        $this->_view->generate(array('user' => $user));
                    } else {
                        $msg = 'A problem occurred during your connection.';
                        $this->_view = new View('Login');
                        $this->_view->generate(array('msg' => $msg));
                    }
                } else {
                    $msg = 'Your logins are incorrect.';
                    $this->_view = new View('Login');
                    $this->_view->generate(array('msg' => $msg));
                }
            }
        }
    }

    private function signUpUser()
    {
        if (isset($_GET['id'])) {
            if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['password'])) {

                $user_name = htmlspecialchars($_POST["name"]);
                $user_username = htmlspecialchars($_POST["username"]);
                $user_mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
                $user_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                $this->_userRepository = new UserRepository();

                if ($this->_userRepository->isEmailTaken($user_mail)) {
                    $msg = 'This email address is already associated with an account !';
                    $this->_view = new View('Signup');
                    $this->_view->generate(array('msg' => $msg));

                    return;
                }

                $this->_userRepository->createUser($user_name, $user_username, $user_mail, $user_password);

                $userInfos = $this->_userRepository->checkInfosRegister($user_name, $user_username, $user_mail);

                if (!empty($userInfos)) {

                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    }

                    // Vérification d'IP et d'agent utilisateur
                    if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
                        session_destroy();
                    }

                    // Génération aléatoire d'identifiants de session
                    session_regenerate_id(true);

                    if (!isset($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }

                    $_SESSION['auth'] = true;
                    $_SESSION['role'] = $userInfos[0]->status();
                    $_SESSION['id'] = $userInfos[0]->idUser();
                    $_SESSION['username'] = $userInfos[0]->username();
                    $_SESSION['name'] = $userInfos[0]->name();

                    if (isset($_SESSION['user_ip'], $_SESSION['user_agent']) &&
                        $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR'] &&
                        $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {

                        $user = $this->_userRepository->getUser($_GET['id']);

                        $this->_view = new View('Singleuser');
                        $this->_view->generate(array('user' => $user));

                    } else {
                        $msg = 'A problem occurred during your connection.';
                        $this->_view = new View('Login');
                        $this->_view->generate(array('msg' => $msg));
                    }
                } else {
                    $msg = 'Your logins for signup are incorrect.';
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
    private function sendEmail()
{
        if (isset($_GET['id']) && $_POST['csrf_token'] == $_SESSION['csrf_token']) {

            require_once './vendor/mailjet/mailjet-apiv3-php/src/Mailjet/Resources.php';

            define('API_USER', 'a847669765140ba252eb1743c9b29396');
            define('API_LOGIN', 'abf1c232ed1081bfb6def81e6a8850c1');

            $mj = new \Mailjet\Client(API_USER,API_LOGIN,true,['version' => 'v3.1']);

            if (isset($_POST['mailForm'])) {
                $name = htmlspecialchars($_POST['name']);
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['mail']);
                $subject = htmlspecialchars($_POST['subject']);
                $message = htmlspecialchars($_POST['message']);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $body = [
                        'Messages' => [
                            [
                                'From' => [
                                    'Email' => "killian.dev4014@gmail.com",
                                    'Name' => $name.' '.$username
                                ],
                                'To' => [
                                    [
                                        'Email' => "support@chaletsetcaviar.killianfilatre.fr",
                                        'Name' => "You"
                                    ]
                                ],
                                'Subject' => $subject,
                                'TextPart' => "De $email Contenu du mail : $message",
                            ]
                        ]
                    ];

                    $response = $mj->post(Resources::$Email, ['body' => $body]);
                    $response->success();
                }
            }

            $msg = 'Your email has been sent.';
            $this->_userRepository = new UserRepository();
            $user = $this->_userRepository->getUser($_GET['id']);
            $this->_view = new View('Singleuser');
            $this->_view->generate(array(
                'user' => $user,
                'msg' => $msg
            ));
        }
    }
}