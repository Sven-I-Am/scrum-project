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
        
            $this->createProduct();
            
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

    public function createProduct ()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
            
                $check = true;
                $response =[];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $priceInput = $_POST['price'];
                $stringPrice = str_replace(",", ".", $priceInput);
                $price = floatval($stringPrice);
                $image = $_POST['image'];

                var_dump($price);
    
                if(empty($_POST['name'])){
    
                    $errors['name'] = "A name is required!";
                    $check = false;
    
                }
    
                if(empty($_POST['description'])){
    
                    $errors['description'] = "A description is required!";
                    $check = false;
    
                }
    
                if(empty($_POST['price'])){
    
                    $errors['price'] = "A price is required!";
                    $check = false;
    
                }elseif($price == 0){

                        $errors['price'] = "The price have to be number.numer or number,number. Example: 12.50, 11,00";
                        $check = false;                   
                }
    
                if(empty($_POST['image'])){
    
                    $errors['image'] = "An image is required!";
                    $check = false;
    
                }elseif(!filter_var($image, FILTER_VALIDATE_URL)){
                    $check = false;
                    $errors['image'] = $image."  is not a valid URL";
                }
    
                if($check === true){
    
                    ProductLoader::createProduct($this->db, new Product(0, Sanitize::sanitizeInput($name), Sanitize::sanitizeInput($description), $price, false, Sanitize::sanitizeInput($image), 1, "12"));
                    $response['status'] = 'success';
    
                }else{
    
                    $response['status'] = 'error';
                    $response['errors'] = $errors;
                }

               return $response;
            }
        }
    
}
