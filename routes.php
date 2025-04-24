<?php

require_once './app/Utils/Router.php';

$router = new Router();

// WEB ROUTES 

$router->get('/', 'app/Controllers/HomeController.php', 'show');
$router->get('/login', 'app/Controllers/LoginController.php', 'show');
$router->get('/signin', 'app/Controllers/SigninController.php', 'show');
$router->get('/products/category', 'app/Controllers/api/ProductController.php', 'show');
$router->get('/products/search', 'app/Controllers/api/ProductController.php', 'handleProductSearch');
$router->get('/product', 'app/Controllers/api/ProductController.php', 'showSingle');
