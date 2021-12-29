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
            $_SESSION['userProducts'] = Productloader::readUserProducts($this->db, $user->getId());
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
        $user = $_SESSION['user'];
        $product = ProductLoader::readOneProduct($this->db, intval($id));
        if ($product->getUserId()===$user->getId()){
            ProductLoader::deleteProduct($this->db, intval($id));
            $_SESSION['userProducts'] = Productloader::readUserProducts($this->db, $user->getId());
            return 'view/dashboard.php';
        } else {
            echo '<script type="text/javascript">alert("You do not have access to this item")</script>';
            return 'view/product.php';
        }

    }


}