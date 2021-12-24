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


        // create a product in the database
        // I have to create some validation to receive de information?
        // I have to change userId for a $_GET['userId']

        if(isset($_POST['submit'])){
        
            ProductLoader::createProduct($this->db, new Product(0, $_POST['name'], $_POST['description'], floatval($_POST['price']), false, $_POST['image'], 1, "12"));
            
        }

        //  delete a product from the database

        if(isset($_POST['delete'])){

            ProductLoader::deleteProduct($this->db, $_GET['id']);

            echo "delete";
        }

        // show all products from the database

        if(isset($_POST['read'])){

            $products = ProductLoader::readAllProducts($this->db);

            foreach($products as $key => $product){

                echo $product->getId()."<br>";
                echo $product->getName()."<br>";
                echo $product->getDescription()."<br>";
                echo $product->getPrice()."<br>";
                echo $product->getSold()."<br>";
                echo $product->getImage()."<br>";
                echo $product->getUserId()."<br>";
                echo $product->getSellDate()."<br>";
    
            }
            
        }
    }
    
}
