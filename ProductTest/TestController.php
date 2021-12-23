<?php

declare(strict_types=1);
// require ('../Model/Product.php');
// require ('../Loader/ProductLoader.php');
// require ('../.env');

require ('TestIndex.php');

class TestController{
    private Connection $db;
    // //create a new connection based on the database value.

    public function __construct(){
        $this->db = new Connection();
    }

    public function render(array $GET, array $POST){


        if(isset($_POST['submit'])){
        
            ProductLoader::createProduct($this->db, new Product(0, $_POST['name'], $_POST['description'], floatval($_POST['price']), false, $_POST['image'], 0, ""));
            
        }

        if(isset($_POST['show'])){

            echo ProductLoader::readAllProducts($this->db);

            echo "show";
        }
    }
    
}
