<?php

declare(strict_types=1);

class HomepageController
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);

        if(!isset($GET['action'])){
            require 'view/product.php';
        } else {
            switch ($GET['action']) {
                case 'logout':
                    require $this->logoutUser();
                    break;
            }
        }
    }

    public function logoutUser() {
        unset($_SESSION['user']);
        echo "<script type='text/javascript'>alert('You logged out');</script>";
        return 'view/product.php';
    }
}