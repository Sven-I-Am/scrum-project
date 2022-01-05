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
                case 'history':
                    require 'view/history.php';
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
        $error = false;
        $emailCheck = Checks::checkEmail($this->db, $POST['email']);
        if (!empty($emailCheck)){
            $email_err = $emailCheck;
            $error = true;
        } else {
            $from = Sanitize::sanitizeInput($POST['email']);
            $buyerMessage = Sanitize::sanitizeInput($POST['message']);
            foreach ($_SESSION['cart'] as $product) {
                $seller = ProductLoader::getUserInfo($this->db, $product);
                $sellerName = $seller->getUserName();
                $to = $seller->getEmail();
                $subject = 'Someone has bought ' . $product->getName();
                $message = "
                    <html>
                        <head>
                          <title></title>
                        </head>
                        <body>
                        <p>Dear " . $sellerName . ",</p>
                        <p>
                        The following product of yours was bought on " . $product->getSellDate() . "<br>
                        <table>
                        <tr>
                        <td>Product name:</td><td>" . $product->getName() . "</td>
                        </tr>
                        <tr>
                        <td>Product description:</td><td>" . $product->getDescription() . "</td>
                        </tr>
                        <tr>
                        <td>Product price:</td><td>" . $product->getPrice() . "</td>
                        </tr>
                        </table>
                        Please contact the buyer to share payment and shipping information. <br>
                        Buyer email adres: " . $from . " <br>
                        If the buyer left you a message you can read it below: <br>
                        <table><tr><td>" . $buyerMessage . "</td></tr></table>
                          </p>
                          <p>Kind regards,</p>
                          <p>The Gbay team</p>
                        </body>
                    </html>
                ";
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                $headers[] = 'From: Gbay Team <noreply@gbay.com>';
                mail($to, $subject, $message, implode("\r\n", $headers));
            }
        }
        if(!$error){
            unset($_SESSION['cart']);
            $total= 0;
            $success = true;
            $success_msg = "Your message was sent to the sellers, please wait for them to contact you with payment information";
        } else {
            $success_msg = '';
        }
        require 'view/cart.php';
    }
}

