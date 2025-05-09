<?php

require_once './app/Utils/Router.php';

$router = new Router();

// Startsidan
$router->get('/', 'app/Controllers/HomeController.php', 'show');

// Autentisering
$router->get('/login', 'app/Controllers/auth/AuthController.php', 'showLogin');
$router->post('/login', 'app/Controllers/auth/AuthController.php', 'login');
$router->get('/signup', 'app/Controllers/auth/AuthController.php', 'showSignup');
$router->post('/signup', 'app/Controllers/auth/AuthController.php', 'signup');
$router->post('/logout', 'app/Controllers/auth/AuthController.php', 'logout');

// Konto
$router->get('/account', 'app/Controllers/AccountController.php', 'show');

// Produkter (API)
$router->get('/products/category', 'app/Controllers/api/ProductController.php', 'show');
$router->get('/products/search', 'app/Controllers/api/ProductController.php', 'handleProductSearch');
$router->get('/product', 'app/Controllers/api/ProductController.php', 'showSingle');

// Varukorg
$router->get('/cart', 'app/Controllers/CartController.php', 'showCart');
$router->post('/cart', 'app/Controllers/CartController.php', 'addToCart');
$router->post('/cart/update', 'app/Controllers/CartController.php', 'updateCart');


// $router->get('/', 'app/Controllers/HomeController.php', 'show');
// $router->get('/login', 'app/Controllers/auth/AuthController.php', 'showLogin');
// $router->get('/signup', 'app/Controllers/auth/AuthController.php', 'showSignup');
// $router->get('/account', 'app/Controllers/AccountController.php', 'show');
// $router->get('/products/category', 'app/Controllers/api/ProductController.php', 'show');
// $router->get('/products/search', 'app/Controllers/api/ProductController.php', 'handleProductSearch');
// $router->get('/product', 'app/Controllers/api/ProductController.php', 'showSingle');
// $router->get('/cart', 'app/Controllers/CartController.php', 'showCart');

// $router->post('/signup', 'app/Controllers/auth/AuthController.php', 'signup');
// $router->post('/login', 'app/Controllers/auth/AuthController.php', 'login');
// $router->post('/logout', 'app/Controllers/auth/AuthController.php', 'logout');
// $router->post('/cart', 'app/Controllers/CartController.php', 'addToCart');
// $router->post('/cart/update', 'app/Controllers/CartController.php', 'updateCart');