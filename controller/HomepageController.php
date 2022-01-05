<?php
class HomepageController
{
    private $db;
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
        $total = 0;
        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $product) {
                $total += $product->getPrice();
            }
        }

        if(!isset($GET['action'])) {
            require 'view/homepage.php';
        } else {
            switch ($GET['action']){
                case 'buy':
                    $this->productCart($POST);

                    break;
                case 'terms':
                    require 'view/terms.php';
                    break;
                case 'filter':
                    $this->filterProducts($GET);
                    break;
                case 'search':
                    $this->search($POST);
                    break;
                case 'cart':
                    require 'view/cart.php';
                    break;
                case 'cancelPurchase':
                    $this->cancelPurchase($POST);
                    break;
                case 'checkout':
                    $this->checkout($POST);
                    break;
            }
        }
    }
  
    public function search($POST) {
      $products = ProductLoader::readAllProductByName($this->db,$POST);
      $categories = FilterLoader::getAllCategories($this->db);
      $universes = FilterLoader::getAllUniverses($this->db);

      require 'view/homepage.php';

    }        

    public function filterProducts($GET){
        $filter = ['universe' => '', 'category' => '', 'condition' => ''];
        if(isset($GET['u'])){
            $filter['universe'] = Sanitize::sanitizeInput($GET['u']);
            $products = ProductLoader::filterProducts($this->db, $filter);
        }elseif(isset($GET['cat'])){
            $filter['category'] = Sanitize::sanitizeInput($GET['cat']);
            $products = ProductLoader::filterProducts($this->db, $filter);
        } elseif(isset($GET['cond'])){
            $filter['condition'] = Sanitize::sanitizeInput($GET['cond']);
            $products = ProductLoader::filterProducts($this->db, $filter);
        }
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        require 'view/homepage.php';
    }

    public function productCart($POST){
        $id = $POST['productId'];
        $product = ProductLoader::readOneProduct($this->db, $id);
        if (!$product->getSold()){
            $date = new DateTime();
            $status = 1;
            ProductLoader::updateSoldStatus($this->db, $id, date_format($date, 'Y-m-d'), $status);
//        unset($_SESSION['cart']);
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = [];
            }
            array_push($_SESSION['cart'], ProductLoader::readOneProduct($this->db, $id));
        } else {
            echo "<script type='text/javascript'>alert('Sorry, this product has already been sold!');</script>";
        }
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);
        require 'view/homepage.php';
    }

    public function cancelPurchase($POST){
        foreach ($_SESSION['cart'] as $key=>$product){
            if($product->getId() == $POST['productId']){
                array_splice($_SESSION['cart'], $key, 1);
            }
        }
        $date = '1984-01-01';
        $id = $POST['productId'];
        $status = 0;
        ProductLoader::updateSoldStatus($this->db, $id, $date, $status);
        header("location: https://gbay-becode.000webhostapp.com//?action=cart");
        require 'view/cart.php';
    }

    public function checkout($POST){
        $buyerEmail = Sanitize::sanitizeInput($POST['email']);
        $buyerMessage = Sanitize::sanitizeInput($POST['message']);
        foreach($_SESSION['cart'] as $product){

        }
        var_dump($_SESSION['cart']);
    }
}

