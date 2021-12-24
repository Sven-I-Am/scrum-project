<?php

declare(strict_types=1);
require_once './Model/User.php';
require_once './Loader/UserLoader.php';

class LoginController
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view

        if(!isset($_GET['action'])){
            require 'View/login.php';
        } else {
            $error = "";
            switch ($_GET['action']) {
                case 'newuser':
                    require 'View/register.php';
                    break;
                case 'register':
                    $this->registerUser();
                    break;
                case 'login':
                    $this->loginUser();
                    break;
            }
        }

    }

    public function registerUser(){
        

        if ($_POST['password'] === $_POST['passwordRepeat']){
            $userName = Sanitize::sanitizeInput($_POST['userName']);
            $email = Sanitize::sanitizeInput($POST['email']);
            $password = Sanitize::sanitizeInput($_POST['password']);
    
            $newUser = new User(0, $userName, $email, $password);
            $user = UserLoader::createUser($this->db, $newUser);
            require 'View/product.php';
        } else {
            $error = "Your passwords do not match, please try again.";
            require 'View/login.php';
        }
    }
  
    public function loginUser(){
        $userName = Sanitize::sanitizeInput($_POST['userName']);
        $password = Sanitize::sanitizeInput($_POST['password']);
        $checkUser = new User (0, $userName, '', $password);
        $response = UserLoader::readOne($this->db, $checkUser);
        if (gettype($response) === 'object'){
            $_SESSION['user'] = $response;
            require 'View/product.php';
        } else {
            echo "<script type='text/javascript'>alert(' . $response . ');</script>";
            require 'View/login.php';
        }
    }
}
