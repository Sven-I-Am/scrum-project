<?php

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

        if(!isset($GET['action'])) {
            require 'view/homepage.php';
        } else {
            switch ($GET['action']){
                case 'buy':
                    $this->productCart($POST);
                    require 'view/homepage.php';
                    break;
                case 'new':
                    $products = ProductLoader::readAllProductByCondition($this->db, "new");
                    require 'view/homepage.php';
                    break;
                case 'good':
                    $products = ProductLoader::readAllProductByCondition($this->db, "good");
                    require 'view/homepage.php';
                    break;
                case 'used':
                    $products = ProductLoader::readAllProductByCondition($this->db, "used");
                    require 'view/homepage.php';
                    break;
            }
        }

    }

    public function productCart($POST){

        $date = new DateTime();
        $id = $POST['productId'];   
        $status = 1;   
                      
        ProductLoader::updateSoldStatus($this->db, $id, date_format($date, 'Y-m-d'), $status);

        unset($_SESSION['cart']);

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }            
        
        array_push($_SESSION['cart'], ProductLoader::readOneProduct($this->db, $id));              
    }
}

