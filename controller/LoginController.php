<?php

declare(strict_types=1);

class LoginController
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }

    public function render(array $GET, array $POST)
    {
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);

        if(!isset($GET['action'])){
            require 'view/login.php';
        } else {
            $error = "";
            switch ($GET['action']) {
                case 'login':
                    require $this->loginUser();
                    break;
            }
        }
    }

    public function loginUser(): string
    {
        $userName = Sanitize::sanitizeInput($_POST['userName']);
        $password = Sanitize::sanitizeInput($_POST['password']);
        $checkUser = new User (0, $userName, '', $password);
        $response = UserLoader::readOne($this->db, $checkUser);
        if (gettype($response) === 'object'){
            $_SESSION['user'] = $response;
            return 'view/product.php';
        } else {
            echo "<script type='text/javascript'>alert(' $response ');</script>";
            return 'view/login.php';
        }
    }


}
