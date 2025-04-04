<?php
require './routes.php';

$base_uri = dirname($_SERVER['SCRIPT_NAME']);
$uri = str_replace($base_uri, '', $_SERVER['REQUEST_URI']);

$uri = rtrim($uri, '/') ?: '/';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

echo $uri;
echo '<br>';
$router->route($uri, $method);
