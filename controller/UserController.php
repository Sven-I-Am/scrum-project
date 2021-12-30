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
                        require 'view/account.php';
                    } else {
                        $userProducts = $this->doAction($POST);
                        require 'view/dashboard.php';
                    }
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
            if (empty($POST["userName"])) {
                $username_err = "Name is required";
                $error = true;
            } else {
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z0-9]*$/",$POST["userName"])) {
                    $username_err = "Username can only have letters and numbers";
                    $error = true;
                } else {
                    //changes here
                    $uniqueTest = Sanitize::sanitizeInput($POST["userName"]);
                    $uniqueResponse = UserLoader::uniqueUser($this->db, $uniqueTest);
                    if (count($uniqueResponse) !== 0) {
                        $error = true;
                        $username_err = "This username is already in use, please choose another one";
                    } else {
                        $newUser->setUserName(Sanitize::sanitizeInput($POST["userName"]));
                    }
                }
            }
            //check email validation
            if (empty($POST['email'])){
                $email_err = "Email is required";
                $error = true;
            } else {
                $email = Sanitize::sanitizeInput($POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $email_err = "Invalid email format";
                    $error = true;
                } else {
                    //changes here
                    $uniqueTest = Sanitize::sanitizeInput($POST["email"]);
                    $uniqueResponse = UserLoader::uniqueEmail($this->db, $uniqueTest);
                    if (count($uniqueResponse) !== 0) {
                        $error = true;
                        $email_err = "You are already registered with this Email!";
                    } else {
                        $newUser->setEmail(Sanitize::sanitizeInput($POST["email"]));
                    }
                }
            }
            //check password validation
            if (empty($POST['password'])){
                $password_err = "Password is required";
                $error = true;
            } else {
                $password = Sanitize::sanitizeInput($POST["password"]);

                if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $POST['password'])) {
                    $password_err = "Password should be the combination of letters and numbers and maximum 8 characters long";
                    $error = true;
                } else{
                    $newUser->setPassword(Sanitize::sanitizeInput($POST['password']));
                }
            }
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
        $response =[];
        $universe = $POST['universe'];
        $category = $POST['category'];
        $condition = $POST['condition'];
        $name = $price = $description = $url = "";

        if (empty($POST['name'])){
            $name_err = "A name is required!";
            $error = true;
        } else {
            $name = Sanitize::sanitizeInput($POST['name']);
        }
        if (empty($POST['price'])){
            $price_err = "A price is required!";
            $error = true;
        } else {
            $price = Sanitize::sanitizeInput($POST['price']);
        }
        if (empty($POST['description'])){
            $description_err = "A description is required!";
            $error = true;
        } else {
            $description = Sanitize::sanitizeInput($POST['description']);
        }
        if (empty($POST['url'])){
            $url_err = 'url is required';
            $error = true;
        } else {
            if(!filter_var($POST['url'], FILTER_VALIDATE_URL)){
                $url_err = $url . "  is not a valid URL";
                $error = true;
            } else {
                $url = Sanitize::sanitizeInput($POST['url']);
            }
        }
        if (!$error){
            $userProducts = Productloader::readUserProducts($this->db, $response->getId(), 'all');
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
