<?php
namespace app\views;
use app\controllers\Router;

require_once '../controllers/Router.php';

$router = new Router();

$router->route();