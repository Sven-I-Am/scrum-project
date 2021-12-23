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
<<<<<<< HEAD
        $handler = $PDO->query('SELECT * FROM USER WHERE email = ' . $email);
        $user = $handler->fetchAll();
=======

        $handler = $PDO->query('SELECT * FROM USER WHERE email = ' . $email);

        $user = $handler->fetchAll();

>>>>>>> b5391a253ae750a6b08cbfd5294524083c0bb0a3
        return new User($user[0]['userid'], $user[0]['username'], $user[0]['email'], $user[0]['password']);
    }

    //Read User
}