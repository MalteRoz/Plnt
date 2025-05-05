<?php

require_once './app/Utils/Router.php';

$router = new Router();

// WEB ROUTES 

$router->get('/', 'app/Controllers/HomeController.php', 'show');
$router->get('/login', 'app/Controllers/auth/AuthController.php', 'showLogin');
$router->get('/signup', 'app/Controllers/auth/AuthController.php', 'showSignup');
$router->get('/products/category', 'app/Controllers/api/ProductController.php', 'show');
$router->get('/products/search', 'app/Controllers/api/ProductController.php', 'handleProductSearch');
$router->get('/product', 'app/Controllers/api/ProductController.php', 'showSingle');

$router->post('/signup', 'app/Controllers/auth/AuthController.php', 'test');
$router->post('/login', 'app/Controllers/auth/AuthController.php', 'login');
