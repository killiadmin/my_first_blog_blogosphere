<?php
require_once './app/views/View.php';
class Router
{
    private $controller;
    private $view;
    /**
     * @var UserRepository
     */
    private $_userRepository;
    /**
     * @var View
     */
    private $_view;

    /**
     * Router of the application which loads the models and controllers according to the url provided
     * @return void
     */
    public function route (): void
    {
        try {
            //Automatically registers an autoload function (the classes in the models folder)
            spl_autoload_register(function ($class){
                if ($class !== 'Resources'){
                    require_once('./app/models/'.$class.'.php');
                }
            });

            //Creation of the Url
            $url = '';

            //We assign the value of the controller according to the variable we give it
            if (isset($_GET['url'])) {
                //URL decomposition with a filter to remove all characters
                $url = explode('/', filter_var($_GET['url'], FILTER_UNSAFE_RAW));

                //We retrieve the first param of the url and apply it in lowercase and the first letter in uppercase
                $ctrl = ucfirst(strtolower($url[0]));

                $ctrlClass = "Controller".$ctrl;

                //We target the desired controller file
                $ctrlFile = "./app/controllers/".$ctrlClass.".php";
                
               

                if (file_exists($ctrlFile)) {
                    //We apply our class with the desired params We use require_once,
                    // if it does not find it the application will return an error
                    require_once($ctrlFile);
                    
                    $this->controller = new $ctrlClass($url);
                } else {
                    throw new \Exception('La page n\'existe pas', 1);
                }
            } else {
                //If no route matches the user will be redirected to the singleUser
                $this->_userRepository = new UserRepository();
                $user = $this->_userRepository->getUser();
                $this->_view = new View('Singleuser');
                $this->_view->generate(array('user' => $user));
            }
        } catch (\Exception $e) {
            $php_errormsg = $e->getMessage();
            $this->_view = new View('NotFound');
            $this->_view->generate(array('php_errormsg' => $php_errormsg));
        }
    }
}