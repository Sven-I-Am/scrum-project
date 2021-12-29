<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//include all connection-related files here
require '.env';
require 'model/Connection.php';
//include all your model files here
require 'model/Product.php';
require 'model/User.php';
//include all loader files here
require 'loader/FilterLoader.php';
require 'loader/ProductLoader.php';
require 'loader/UserLoader.php';
//include all your controllers here
require 'controller/HomepageController.php';
require 'controller/LoginController.php';
require 'controller/RegisterController.php';
//include all helper files here
require 'view/component.php';
require 'helper/Sanitize.php';

session_start();
//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!
if (isset($_GET['login']))
{
    $controller = new LoginController();
}
elseif (isset($_GET['register']))
{
    $controller = new RegisterController();
}
else
{
    $controller = new HomepageController();
}

$controller->render($_GET, $_POST);

//remove below before full deployment
whatIsHappening();
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}