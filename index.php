<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//include all your model files here
//require connection
require 'Model/Connection.php';
require '.env';
//include all your model files here
require 'Model/User.php';
require 'Model/Product.php';
//include all Loaders here
require 'Loader/UserLoader.php';
//include all your controllers here
require 'Controller/HomepageController.php';
require 'Controller/LoginController.php';
require 'Helper/Sanitize.php';

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!
if(!isset($_GET['page']) || $_GET['page']==='home') {
    $controller = new HomepageController();
} elseif ($_GET['page'] === 'login') {
    $controller = new LoginController();
}


//$controller = new LoginController();

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