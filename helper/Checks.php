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
                if (count($uniqueResponse) !== 0) {
                    var_dump($uniqueResponse);
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
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email format";
            } else {
                //changes here
                $uniqueTest = Sanitize::sanitizeInput($email);
                $uniqueResponse = UserLoader::uniqueEmail($PDO, $uniqueTest);
                if (count($uniqueResponse) !== 0) {
                    return "You are already registered with this Email!";
                } else {
                    return '';
                }
            }
        }
    }
    public static function checkPassword(string $password): string
    {
        if (empty($password)){
            return "Password is required";
        } else {
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
                return "Password should be the combination of letters and numbers and at least 8 characters long";
            } else{
                return '';
            }
        }
    }
}