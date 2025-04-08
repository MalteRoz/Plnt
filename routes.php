<?php

require_once './app/Utils/Router.php';

$router = new Router();

$router->get('/', 'app/Controllers/HomeController.php', 'show');
