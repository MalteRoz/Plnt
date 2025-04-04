<?php

require_once './Utils/Router.php';

$router = new Router();

$router->get('/', 'Controllers/HomeController.php', 'show');
