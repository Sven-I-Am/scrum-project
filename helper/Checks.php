<?php

class Checks
{
    public static function checkUserName(PDO $PDO, string $userName): string
    {
        if (empty($userName)) {
            return "Name is required";
        } else {
            
            // check if name only contains letters and whitespace

            if (!preg_match("/^[a-zA-Z0-9]*$/",$userName)) {
                return "Username can only have letters and numbers";
            } else {
                $uniqueResponse = UserLoader::uniqueUser($PDO, $userName);
                if ($uniqueResponse) {
                    return "This username is already in use, please choose another one";
                } else {
                    return '';
                }
            }
        }
    }
    public static function checkEmail(PDO $PDO, string $email): string
    {
        if (empty($email)){
            return "Email is required";
        } else {

            // check if email address is well-formed
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email format";
            } else {
                //changes here
                if ($_GET['action']!=='askReset' && $_GET['action']!=='reset' && $_GET['action']!=='checkout'){
                    $uniqueTest = Sanitize::sanitizeInput($email);
                    $uniqueResponse = UserLoader::uniqueEmail($PDO, $uniqueTest);
                    if ($uniqueResponse) {
                        return "An account is already registered to this email address!";
                    } else {
                        return '';
                    }
                } else {
                    return '';
                }

            }
        }
    }
    public static function checkPassword(string $password): string
    {
        // checking password matches
        
        if (empty($password)){
            return "Password is required";
        } else {
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,999}$/', $password)) {
                return "Password should be the combination of letters and numbers and at least 8 characters long";
            } else{
                return '';
            }
        }
    }
    public static function checkToken(int $token): string
    {
        if (empty($token)){
            return 'Please enter a valid token';
        } else {
            return '';
        }
    }
}