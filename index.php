<?php

declare(strict_types=1);

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
require 'controller/UserController.php';
//include all helper files here
require 'helper/component.php';
require 'helper/Sanitize.php';
require 'helper/Checks.php';



session_start();
//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!
if (isset($_GET['user']))
{
    $controller = new UserController();
}
else
{
    $controller = new HomepageController();
}

$controller->render($_GET, $_POST);
