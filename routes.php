<?php

require_once './app/Utils/Router.php';

$router = new Router();

$router->get('/', 'app/Controllers/HomeController.php', 'show');
$router->get('/login', 'app/Controllers/LoginController.php', 'show');
$router->get('/signin', 'app/Controllers/SigninController.php', 'show');
