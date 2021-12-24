<?php

class UserLoader
{

    //create CRUD functionalities
    //Create new user
    public static function createUser(PDO $PDO, User $newUser): User
    {
        $userName ='"' . $newUser->getUserName() . '"';
        $email = '"' . $newUser->getEmail() . '"';
        $password ='"' . password_hash($newUser->getPassword(), PASSWORD_DEFAULT) . '"';

        $PDO->query('INSERT INTO USER(username, email, password) VALUES (' . $userName . ', ' . $email . ', ' . $password . ')');

        $handler = $PDO->query('SELECT * FROM USER WHERE email = ' . $email);
        $user = $handler->fetchAll();
        return new User($user[0]['userid'], $user[0]['username'], $user[0]['email'], $user[0]['password']);
    }

    //Read One User
    public static function readOne(PDO $PDO, User $checkUser){
        $userName ='"' . $checkUser->getUserName() . '"';
        $password =$checkUser->getPassword();
        $handler = $PDO->query('SELECT * FROM USER WHERE username = '. $userName);
        $response = $handler->fetchAll();
        if(password_verify($password, $response[0]['password'])){
            return new User($response[0]['userid'], $response[0]['username'], $response[0]['email'], $response[0]['password']);
        } else {
            return "The combination username & password is invalid, please check your input";
        }
    }
}