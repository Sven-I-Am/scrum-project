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
            }
        }

    }

    public function productCart($POST){

        var_dump($POST['productId']);
        $date = new DateTime();
        $id = $POST['productId'];      
                      
        ProductLoader::updateSoldStatus($this->db, $id, date_format($date, 'Y-m-d'));

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }            
        

        array_push($_SESSION['cart'], ProductLoader::readOneProduct($this->db, $id));              

    }
}

