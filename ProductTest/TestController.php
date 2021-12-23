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
            echo "ola";
        
           var_dump($_POST['name']); 
           var_dump($_POST['description']); 
           var_dump(floatval($_POST['price'])); 
           var_dump($_POST['image']);

        //    $price = floatval($_POST['price']);
        
            // $product = new Product("", $_POST['name'], $_POST['description'], floatval($_POST['price']), false, $_POST['image'], 0, "");
            // $database = new ProductLoader();
        
            // $database->createProduct($product);
        
            ProductLoader::createProduct($this->db, new Product(0, $_POST['name'], $_POST['description'], floatval($_POST['price']), false, $_POST['image'], 0, ""));
        }
    }
    
}
