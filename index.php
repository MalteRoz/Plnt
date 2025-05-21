<?php
require_once './routes.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/utils/IncludeFunction.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/vendor/autoload.php';
// require_once './bootstrap.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "<br>";

$base_uri = dirname($_SERVER['SCRIPT_NAME']);
$uri = str_replace($base_uri, '', $_SERVER['REQUEST_URI']);

$uri = rtrim($uri, '/') ?: '/';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
