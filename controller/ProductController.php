<?php

declare(strict_types=1);

class ProductController
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
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $userProducts = Productloader::readUserProducts($this->db, $user->getId());
        }

        if(!isset($GET['action'])){
            require 'view/product.php';
        } else {
            switch ($GET['action']){
                case 'productChange':
                    if(isset($POST['update'])){
                        require $this->updateProduct($POST['productId']);
                    } elseif(isset($POST['delete'])) {
                        require $this->deleteProduct($POST['productId']);
                    }
                    break;
            }
        }
    }

    public function deleteProduct($id): string
    {
        $product = ProductLoader::readOneProduct($this->db, intval($id));
        return 'view/dashboard.php';
    }


}