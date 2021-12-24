<?php

declare(strict_types=1);

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
                case 'register':
                    $this->registerUser();
                    break;
                case 'newuser':
                    require 'View/register.php';
                    break;
            }
        }

    }

    public function registerUser(){
        if ($_POST['password'] === $_POST['passwordRepeat']){
            $newUser = new User(0, $_POST['userName'], $_POST['email'], $_POST['password']);
            $user = UserLoader::createUser($this->db, $newUser);
            require 'View/product.php';
        } else {
            $error = "Your passwords do not match, please try again.";
            require 'View/login.php';
        }
    }
}
