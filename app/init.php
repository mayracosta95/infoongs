<?php

define("APP_PATH", dirname($_SERVER['DOCUMENT_ROOT']));

use Utils\Router;
use Controllers\Controller;

try {
    
    $env = include("env.php");
    if(!is_array($env) || empty($env)) throw new Exception("Enviroment not set");
    define("APP_ENV", $env);

    $routes = include("routes.php");
    if(!is_array($routes) || empty($routes)) throw new Exception("Routes not set");
    define("APP_ROUTES", $env);

    $layouts = include("layouts.php");
    if(!is_array($layouts) || empty($layouts)) $layouts = [];
    define("APP_LAYOUTS", $layouts);

} catch(Exception $ex) {
    Controller::show500($ex->getMessage());
}

if(@ APP_ENV["config"]["debug"] == true) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

spl_autoload_register(function ($class) {
    include_once APP_PATH ."/". lcfirst($class) .".php";
});

$router = new Router();
foreach($routes as $url => $handler) {
    $arrHandler = explode("::", $handler);
    $router->set(url: $url, class: $arrHandler[0], function: $arrHandler[1]);
}
$router->run();