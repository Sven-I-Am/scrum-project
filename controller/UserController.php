<?php

declare(strict_types=1);

class UserController
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }

    public function render(array $GET, array $POST)
    {
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }

        if(!isset($GET['action'])){
            require 'view/login.php';
        } else {
            switch ($GET['action']) {
                case 'register':
                    require 'view/register.php';
                    break;
                case 'registerUser':
                    $this->registerUser($POST);
                    break;
                case 'login':
                    $this->loginUser($POST);
                    break;
                case 'logout':
                    $this->logoutUser();
                    break;
                case 'dashboard':
                    if (isset($_GET['account'])) {
                        if(isset($_POST['deleteAccount'])){
                            $this->deleteUser();
                        } else {
                            require 'view/account.php';
                        }
                    } else {
                        $userProducts = $this->doAction($POST);
                        require 'view/dashboard.php';
                    }
                    break;
                case'updateUser':
                    $this->updateUser($POST);
                    break;
                case 'addProduct':
                    if(isset($POST['save'])){
                        $this->createProduct($POST);
                    } elseif(isset($POST['cancel'])) {
                        $userProducts = $this->doAction($POST);
                        require 'view/dashboard.php';
                    }else {
                        require 'view/addProduct.php';
                    }
                    break;
                case 'productChange':
                    if(isset($POST['update'])){
                        echo 'test';
                        //require $this->updateProduct($POST['productId']);
                    } elseif(isset($POST['delete'])) {
                        $this->deleteProduct($POST['productId']);
                    }
                    break;
            }
        }
    }

    public function registerUser($POST) {
        if ($POST['password'] === $POST['passwordRepeat']){
            $newUser = new User(0, '', '', '');
            $error = false;
            //check username validation
            $userNameCheck = Checks::checkUserName($this->db, $POST['userName']);
            if (!empty($userNameCheck)){
                $userName_err = $userNameCheck;
                $error = true;
            } else {
                $newUser->setUserName(Sanitize::sanitizeInput($POST["userName"]));
            }
            //check email validation
            $emailCheck = Checks::checkEmail($this->db, $POST['email']);
            if (!empty($emailCheck)){
                $email_err = $emailCheck;
                $error = true;
            } else {
                $newUser->setEmail(Sanitize::sanitizeInput($POST["email"]));
            }
            //check password validation
            $passwordCheck = Checks::checkPassword($POST['password']);
            if (!empty($passwordCheck)){
                $password_err = $passwordCheck;
                $error = true;
            } else {
                $newUser->setPassword(Sanitize::sanitizeInput($POST["password"]));
            }
            //create user in db
            if($error === false){
                UserLoader::createUser($this->db, $newUser);
                echo "<script type='text/javascript'>alert('You are registered. Please login to get access to all functionalities');</script>";
                require 'view/login.php';
            }else {
                require 'view/register.php';
            }
        } else {
            $passwordRepeat_err = "Your passwords do not match, please try again.";
            require 'view/register.php';
        }
    }

    public function updateUser($POST)
    {
        $userName = Sanitize::sanitizeInput($POST['userName']);
        $email = Sanitize::sanitizeInput($POST['email']);
        $password = Sanitize::sanitizeInput($POST['password']);
    }

    public function loginUser($POST)
    {
        $userName = Sanitize::sanitizeInput($POST['userName']);
        $password = Sanitize::sanitizeInput($POST['password']);
        $checkUser = new User (0, $userName, '', $password);
        $response = UserLoader::readOne($this->db, $checkUser);
        if (gettype($response) === 'object'){
            $_SESSION['user'] = $response;
            $_POST=[];
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            $userProducts = Productloader::readUserProducts($this->db, $response->getId(), 'all');
            require 'view/dashboard.php';
        } else {
            echo "<script type='text/javascript'>alert(' $response ');</script>";
            require 'view/login.php';
        }
    }

    public function logoutUser() {
        $_SESSION['user']->setOffline($this->db, $_SESSION['user']->getId());
        unset($_SESSION['user']);
        echo "<script type='text/javascript'>alert('You logged out');</script>";
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);
        require 'view/product.php';
    }

    public function deleteUser(){
        UserLoader::deleteUser($this->db, $_SESSION['user']);
        unset($_SESSION['user']);
        echo "<script type='text/javascript'>alert('You deleted your account');</script>";
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);
        require 'view/product.php';
    }

    public function doAction($POST): array
    {
        if (isset($POST['showSoldProducts'])){
            return Productloader::readUserProducts($this->db, $_SESSION['user']->getId(), 'sold');
        } elseif (isset($POST['showUnsoldProducts'])) {
            return Productloader::readUserProducts($this->db, $_SESSION['user']->getId(), 'unsold');
        } else {
            return Productloader::readUserProducts($this->db, $_SESSION['user']->getId(), 'all');
        }
    }

    public function createProduct($POST)
    {
        $error = false;
        $universe = $POST['universe'];
        $category = $POST['category'];
        $condition = $POST['condition'];
        $newProduct = new Product(0, '', $condition, '', 0,false, '',$_SESSION['user']->getId(),'1984-01-01', intval($category), intval($universe));

        if (empty($POST['name'])){
            $name_err = "A name is required!";
            $error = true;
        } else {
            $name = Sanitize::sanitizeInput($POST['name']);
            $newProduct->setName($name);
        }
        if (empty($POST['price'])){
            $price_err = "A price is required!";
            $error = true;
        } else {
            if(!preg_match("/^[+-]?([0-9]*[.])?[0-9]+$/",$POST['price'])){
                $price_err = "Invalid price, use format 00.00";
                $error = true;
            } else {
                $price = floatval(str_replace(",", ".", Sanitize::sanitizeInput($POST['price'])));
                $newProduct->setPrice($price);
            }
        }
        if (empty($POST['description'])){
            $description_err = "A description is required!";
            $error = true;
        } else {
            $description = Sanitize::sanitizeInput($POST['description']);
            $newProduct->setDescription($description);
        }
        if (empty($POST['url'])){
            $url_err = 'url is required';
            $error = true;
        } else {
            if(!filter_var($POST['url'], FILTER_VALIDATE_URL)){
                $url_err = $POST['url'] . "  is not a valid URL";
                $error = true;
            } else {
                $url = Sanitize::sanitizeInput($POST['url']);
                $newProduct->setImage($url);
            }
        }
        if (!$error){
            ProductLoader::createProduct($this->db, $newProduct);
            $userProducts = Productloader::readUserProducts($this->db, $_SESSION['user']->getId(), 'all');
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            require 'view/dashboard.php';
        } else {
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            require 'view/addProduct.php';
        }
    }

    public function deleteProduct($id)
    {
        $user = $_SESSION['user'];
        $product = ProductLoader::readOneProduct($this->db, intval($id));
        if ($product->getUserId()===$user->getId()){
            ProductLoader::deleteProduct($this->db, intval($id));
            $userProducts = Productloader::readUserProducts($this->db, $user->getId(), 'all');
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            require 'view/dashboard.php';
        } else {
            echo '<script type="text/javascript">alert("You do not have access to this item")</script>';
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            $products = ProductLoader::readAllProducts($this->db);
            require 'view/product.php';
        }

    }
}

