<?php

class RegisterController
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }
    public function render(array $GET, array $POST)
    {
        if(!empty($POST) && $GET['action'] === 'register'){
            $this->registerUser();
        } else {
            require 'view/register.php';
        }
    }

    public function registerUser(){

        $userName = $email = $password = "";
        if ($_POST['password'] === $_POST['passwordRepeat']){
            $newUser = new User(0, '', '', '');
            $error = false;
            //check username validation
            if (empty($_POST["userName"])) {
                $username_err = "Name is required";
                $error = true;
            } else {
                $userName = Sanitize::sanitizeInput($_POST["userName"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["userName"])) {
                    $username_err = "Username can only have letters and numbers";
                    $error = true;
                } else {
                    //changes here
                    $uniqueTest = Sanitize::sanitizeInput($_POST["userName"]);
                    $uniqueResponse = UserLoader::uniqueUser($this->db, $uniqueTest);
                    if (count($uniqueResponse) !== 0) {
                        $error = true;
                        $username_err = "This username is already in use, please choose another one";
                    } else {
                        $newUser->setUserName(Sanitize::sanitizeInput($_POST["userName"]));
                    }
                }
            }
            //check email validation
            if (empty($_POST['email'])){
                $email_err = "Email is required";
                $error = true;
            } else {
                $email = Sanitize::sanitizeInput($_POST["email"]);

                // check if e-mail address is well-formed
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $email_err = "Invalid email format";
                    $error = true;
                } else {
                    //changes here
                    $uniqueTest = Sanitize::sanitizeInput($_POST["email"]);
                    $uniqueResponse = UserLoader::uniqueEmail($this->db, $uniqueTest);
                    if (count($uniqueResponse) !== 0) {
                        $error = true;
                        $email_err = "You are already registered with this Email!";
                    } else {
                        $newUser->setEmail(Sanitize::sanitizeInput($_POST["email"]));
                    }
                }
            }
            //check password validation
            if (empty($_POST['password'])){
                $password_err = "Password is required";
                $error = true;
            } else {
                $password = Sanitize::sanitizeInput($_POST["password"]);

                if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['password'])) {
                    $password_err = "Password should be the combination of letters and numbers and maximum 8 characters long";
                    $error = true;
                } else{
                    $newUser->setPassword(Sanitize::sanitizeInput($_POST['password']));
                }
            }
            if($error === false){
                $user = UserLoader::createUser($this->db, $newUser);
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
}