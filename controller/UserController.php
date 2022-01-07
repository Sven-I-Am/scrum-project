<?php

declare(strict_types=1);

class UserController
{
    private $db;
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
            if(!isset($GET['uAuth'])){
                require 'view/user/loginForm.php';
            } else {
                $id = $GET['uAuth'];
                require 'view/user/passwordResetForm.php';
            }
        } else {
            switch ($GET['action']) {
                case 'register':
                    require 'view/user/registerForm.php';
                    break;
                case 'registerUser':
                    $this->registerUser($POST);
                    break;
                case 'login':
                    $this->loginUser($POST);
                    break;
                case 'logout':
                    $this->logoutUser($user);
                    break;
                case 'askReset':
                    if(!isset($_POST['email'])){
                        require 'view/user/askReset.php';
                    } else {
                        $this->askReset($POST);
                    }
                    break;
                case 'reset':
                    $this->resetPassword($POST);
                    break;
                case 'dashboard':
                    if (isset($_GET['account'])) {
                        if(isset($_POST['deleteAccount'])){
                            $this->deleteUser($user);
                        } else {
                            require 'view/user/updateUserForm.php';
                        }
                    } else {
                        $userProducts = $this->doAction($POST, $user);
                        require 'view/dashboard.php';
                    }
                    break;
                case'updateUser':
                    $this->updateUser($POST, $user);
                    break;
                case 'addProduct':
                    if(isset($POST['save'])){
                        $this->writeProduct($POST, $user);
                    } elseif(isset($POST['cancel'])) {
                        $userProducts = $this->doAction($POST, $user);
                        require 'view/dashboard.php';
                    }else {
                        require 'view/product/addProductForm.php';
                    }
                    break;
                case 'productChange':
                    if(isset($POST['update'])){
                        $product = ProductLoader::readOneProduct($this->db, intval($POST['productId']));
                        require 'view/product/updateProductForm.php';
                    } elseif(isset($POST['delete'])) {
                        $this->deleteProduct($POST['productId'], $user);
                    }
                    break;
                case 'updateProduct':
                    $this->writeProduct($POST, $user);
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
            if (!isset($POST['terms'])){
                $terms_err = 'You must agree to our terms of use in order to register';
                $error= true;
            }
            //create user in db
            if(!$error){
                UserLoader::createUser($this->db, $newUser);
                echo "<script type='text/javascript'>alert('You are registered. Please login to get access to all functionalities');</script>";
                require 'view/user/loginForm.php';
            }else {
                require 'view/user/registerForm.php';
            }
        } else {
            $passwordRepeat_err = "Your passwords do not match, please try again.";
            require 'view/user/registerForm.php';
        }
    }

    public function updateUser($POST, $user)
    {
        $userName = $POST['userName'];
        $email = $POST['email'];
        $password = $POST['password'];
        if (password_verify($password, $user->getPassword())){
            $newUser = new User(0, $userName, $email, '');
            $error = false;
            //check username validation
            if ($user->getUserName() !== $POST['userName']){
                $userNameCheck = Checks::checkUserName($this->db, $POST['userName']);
                if (!empty($userNameCheck)){
                    $userName_err = $userNameCheck;
                    $error = true;
                } else {
                    $newUser->setUserName(Sanitize::sanitizeInput($POST["userName"]));
                }
            }
            if ($user->getEmail() !== $POST['email']){
                $emailCheck = Checks::checkEmail($this->db, $POST['email']);
                if (!empty($emailCheck)){
                    $email_err = $emailCheck;
                    $error = true;
                } else {
                    $newUser->setEmail(Sanitize::sanitizeInput($POST["email"]));
                }
            }
            if(!$error){
                $_SESSION['user'] = UserLoader::updateUser($this->db, $user, $newUser);
                echo "<script type='text/javascript'>alert('Your account information has been updated.');</script>";
                require 'view/dashboard.php';
            }else {
                require 'view/user/updateUserForm.php';
            }
        } else {
            $password_err = 'Invalid password';
            require 'view/user/updateUserForm.php';
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
            header("location: https://gbay-becode.000webhostapp.com/?user&action=dashboard");
            require 'view/dashboard.php';
        } else {
            echo "<script type='text/javascript'>alert(' $response ');</script>";
            require 'view/user/loginForm.php';
        }
    }

    public function logoutUser($user) {
        $user->setOffline($this->db, $user->getId());
        unset($_SESSION['user']);
        if(isset($_SESSION['cart'])){
            $cartProducts = $_SESSION['cart'];
            foreach ($cartProducts as $product){
                $date = '1984-01-01';
                $id = $product->getId();
                $status = 0;
                ProductLoader::updateSoldStatus($this->db, $id, $date, $status);
            }
            unset($_SESSION['cart']);
        }
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);
        header("location: https://gbay-becode.000webhostapp.com/");
        require 'view/homepage.php';
    }

    public function deleteUser($user){
        UserLoader::deleteUser($this->db, $user);
        unset($_SESSION['user']);
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);
        header("location: https://gbay-becode.000webhostapp.com/");
        require 'view/homepage.php';
    }

    public function askReset($POST){
        $error = false;
        $emailCheck = Checks::checkEmail($this->db, $POST['email']);
        if (!empty($emailCheck)){
            $email_err = $emailCheck;
            $error = true;
        } else {
            $strToken = rand(999, 99999);
            $email = Sanitize::sanitizeInput($POST['email']);
            $response = UserLoader::setToken($this->db, $strToken, $email);
            if(!empty($response)){

                $userName = $response['userName'];
                $id = $response['id'];
                $to = $email;
                $subject = 'GBay - Password reset requested';
                $message = "
                    <html>
                    <head>
                      <title>A password reset was requested</title>
                    </head>
                    <body>
                    <p>Dear " . $userName . ",</p>
                      <p>A password reset was requested for your Gbay account. <br>
                      <a href='https://gbay-becode.000webhostapp.com//?user&uAuth=" . $id . "'>Click here to reset your password!</a></p>
                      <p>Enter the following code to authenticate your reset: <strong>" . $strToken . "</strong></p>
                      <p>If you didn't request this action, you can disregard this message.</p>
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
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            $products = ProductLoader::readAllProducts($this->db);
           header("location: https://gbay-becode.000webhostapp.com//");
            require 'view/homepage.php';
        } else {
            require 'view/user/askReset.php';
        }

    }

    public function resetPassword($POST)
    {
        $error = false;
        if ($POST['password'] === $POST['passwordRepeat']) {
            $user = new User(0, '', '', '');
            //check email validation
            $emailCheck = Checks::checkEmail($this->db, $POST['email']);
            if (!empty($emailCheck)) {
                $email_err = $emailCheck;
                $error = true;
            } else {
                $user->setEmail(Sanitize::sanitizeInput($POST["email"]));
            }
            //check password validation
            $passwordCheck = Checks::checkPassword($POST['password']);
            if (!empty($passwordCheck)) {
                $password_err = $passwordCheck;
                $error = true;
            } else {
                $user->setPassword(Sanitize::sanitizeInput($POST["password"]));
            }
            //check token validation
            $tokenCheck = Checks::checkToken(intval($POST['token']));
            if (!empty($tokenCheck)) {
                $token_err = $tokenCheck;
                $error = true;
            } else {
                $token = Sanitize::sanitizeInput($POST["token"]);
                $token_err = UserLoader::resetPassword($this->db, $user, $token);
                if (!empty($token_err)){
                    $error = true;
                }
            }
        } else {
            $password_err = "Passwords don't match";
            require 'view/user/updateUserForm.php';
        }
        if(!$error){
            require 'view/user/loginForm.php';
        } else {
            require 'view/user/passwordResetForm.php';
        }
    }

    public function doAction($POST,$user): array
    {
        if (isset($POST['showSoldProducts'])){
            return Productloader::readUserProducts($this->db, $user->getId(), 'sold');
        } elseif (isset($POST['showUnsoldProducts'])) {
            return Productloader::readUserProducts($this->db, $user->getId(), 'unsold');
        } else {
            return Productloader::readUserProducts($this->db, $user->getId(), 'all');
        }
    }

    public function writeProduct($POST, $user)
    {
        $error = false;
        $universe = $POST['universe'];
        $category = $POST['category'];
        $condition = $POST['condition'];
        $newProduct = new Product(0, '', $condition, '', 0,false, '',$user->getId(),'1984-01-01', intval($category), intval($universe));

        if(isset($POST['nrOf'])){
            if(empty($POST['nrOf'])){
                $nr_err = "Specify the amount of products you wish to sell!";
                $error = true;
            } else {
                if ($POST['nrOf'] < 1 || $POST['nrOf'] > 5) {
                    $nr_err = "Enter a number between 1 and 5!";
                    $error = true;
                }else{
                    $nrOf = Sanitize::sanitizeInput($POST['nrOf']);
                }
            }
        }

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
            if($_GET['action']==='addProduct'){
                for ($i = 0; $i < $nrOf; $i++){
                    ProductLoader::createProduct($this->db, $newProduct);
                }
            } else {
                $newProduct->setId(intval($POST['productId']));
                ProductLoader::updateProduct($this->db, $newProduct);
            }
            $userProducts = Productloader::readUserProducts($this->db, $user->getId(), 'all');
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            header("location: https://gbay-becode.000webhostapp.com/?user&action=dashboard");
            require 'view/dashboard.php';
        } else {
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            if($_GET['action']==='addProduct'){
                require 'view/product/addProductForm.php';
            } else {
                $product = ProductLoader::readOneProduct($this->db, intval($POST['productId']));
                require 'view/product/updateProductForm.php';
            }
        }
    }

    public function deleteProduct($id, $user)
    {
        $product = ProductLoader::readOneProduct($this->db, intval($id));
        if ($product->getUserId()===$user->getId()){
            ProductLoader::deleteProduct($this->db, intval($id));
            $userProducts = Productloader::readUserProducts($this->db, $user->getId(), 'all');
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            header("location: https://gbay-becode.000webhostapp.com/?user&action=dashboard");
            require 'view/dashboard.php';
        } else {
            $categories = FilterLoader::getAllCategories($this->db);
            $universes = FilterLoader::getAllUniverses($this->db);
            $products = ProductLoader::readAllProducts($this->db);
            header("location: https://gbay-becode.000webhostapp.com/?user&action=dashboard");
            require 'view/homepage.php';
        }

    }
}

