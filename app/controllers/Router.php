<?php
namespace app\controllers;

class Router
{
    private $controller;
    private $view;

    public function route ()
    {
        try {
            //Enregistre automatiquement une fonction d'autoload (les classes du dossier models)
            spl_autoload_register(function ($class){
                require_once('models/'.$class.'.php');
            });

            //Création de l'url
            $url = '';

            //On affecte la valuer du controleur suivant la variable qu'on lui donne
            if (isset($_GET['url'])) {
                //Décomposition de l'url avec un filtre pour supprimer tous les caractères
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                //On récupère le premier param de l'url et lapplique en minuscule et la première lettre en majuscule
                $ctrl = ucfirst(strtolower($url[0]));

                $ctrlClass = "Controller".$ctrl;

                //On cible le fichier controller voulu
                $ctrlFile = "controllers/".$ctrlClass.".php";

                if (file_exists($ctrlFile)) {
                    //On applique notre class avec les params voulu
                    //On utilise require_once, s'il ne le trouve pas l'application retournera une erreur
                    require_once($ctrlFile);
                    $this->controller = new $ctrlClass($url);
                } else {
                    throw new \Exception('La page n\'existe pas', 1);
                }
            } else {
                //Si aucune route ne match l'utilisateur sera redirigé vers l'accueil
                require_once ('controllers/HomeController.php');
                $this->controller = new HomeController($url);
            }
        } catch (\Exception $e) {
            $php_errormsg = $e->getMessage();
            require_once ('views/notfound.php');
        }
    }
}