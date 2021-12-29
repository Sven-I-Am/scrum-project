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
            $userProducts = Productloader::readUserProducts($this->db, $user->getId());
        }

        if(!isset($GET['action'])){
            require 'view/login.php';
        } else {
            $error = "";
            switch ($GET['action']) {
                case 'register':
                    require 'view/register.php';
                    break;
                case 'registerUser':
                    require $this->registerUser($POST);
                    break;
                case 'login':
                    require $this->loginUser($POST);
                    break;
                case 'logout':
                    require $this->logoutUser();
                    break;
                case 'dashboard':
                    require 'view/dashboard.php';
                    break;
            }
        }
    }

    public function registerUser($POST): string
    {

        $userName = $email = $password = "";
        if ($POST['password'] === $POST['passwordRepeat']){
            $newUser = new User(0, '', '', '');
            $error = false;
            //check username validation
            if (empty($POST["userName"])) {
                $username_err = "Name is required";
                $error = true;
            } else {
                $userName = Sanitize::sanitizeInput($POST["userName"]);
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
                $user = UserLoader::createUser($this->db, $newUser);
                echo "<script type='text/javascript'>alert('You are registered. Please login to get access to all functionalities');</script>";

                return 'view/login.php';
            }else {
                return 'view/register.php';
            }
        } else {
            $passwordRepeat_err = "Your passwords do not match, please try again.";
            return 'view/register.php';
        }
    }

    public function loginUser($POST): string
    {
        $userName = Sanitize::sanitizeInput($POST['userName']);
        $password = Sanitize::sanitizeInput($POST['password']);
        $checkUser = new User (0, $userName, '', $password);
        $response = UserLoader::readOne($this->db, $checkUser);
        if (gettype($response) === 'object'){
            $_SESSION['user'] = $response;
            $_POST=[];
            return 'view/dashboard.php';
        } else {
            echo "<script type='text/javascript'>alert(' $response ');</script>";
            return 'view/login.php';
        }
    }

    public function logoutUser() {
        unset($_SESSION['user']);
        echo "<script type='text/javascript'>alert('You logged out');</script>";
        return 'view/product.php';
    }
}
