<?php

class UserLoader
{

    //create CRUD functionalities
    //Create new user
    public static function createUser(PDO $PDO, User $newUser): User
    {
        $userName = $newUser->getUserName();
        $email = $newUser->getEmail();
        $password = password_hash($newUser->getPassword(), PASSWORD_DEFAULT);

        $stmt = $PDO->prepare('INSERT INTO USER(username, email, password) VALUES(:userName,:email, :password)');
        $stmt->execute([':userName' => $userName, ':email' => $email, ':password' => $password]);
        $stmt = null;
        $handler = $PDO->query('SELECT * FROM USER WHERE email = "' . $email . '"');
        $user = $handler->fetchAll();
        return new User($user[0]['userid'], $user[0]['username'], $user[0]['email'], $user[0]['password']);
    }

    //Read One User
    public static function readOne(PDO $PDO, User $checkUser): User | string
    {
        $userName ='"' . $checkUser->getUserName() . '"';
        $password =$checkUser->getPassword();
        $handler = $PDO->query('SELECT * FROM USER WHERE username = '. $userName);
        $response = $handler->fetchAll();
        $user = new User($response[0]['userid'], $response[0]['username'], $response[0]['email'], $response[0]['password']);
        if(password_verify($password, $response[0]['password']) && $user->checkOnline($PDO,$user->getId())==0){
            $user->setOnline($PDO, $user->getId());
            return $user;
        } else {
            return "The combination username & password is invalid, please check your input";
        }
    }
    public static function uniqueUser(PDO $PDO, string $userName){
        $handler = $PDO->query('SELECT * FROM USER WHERE username = "'. $userName . '"');
        return $handler->fetchAll();
    }
    public static function uniqueEmail(PDO $PDO, string $email){
        $handler = $PDO->query('SELECT * FROM USER WHERE email = "'. $email . '"');
        return $handler->fetchAll();
    }
    public static function updateUser(PDO $PDO, User $oldUser, User $newUser): User
    {
        $userid = '"' . $oldUser->getId() . '"';
        $userName = '"' . $newUser->getUserName() . '"';
        $email = '"' . $newUser->getEmail() . '"';

        $PDO->query('UPDATE USER SET username = ' . $userName . ', email = ' . $email . ' WHERE userid = ' . $userid);
        $handler = $PDO->query('SELECT * FROM USER WHERE userid = ' . $userid);
        $updatedUser = $handler->fetchAll();
        return new User($updatedUser[0]['userid'], $updatedUser[0]['username'], $updatedUser[0]['email'], $updatedUser[0]['password']);
    }
    public static function deleteUser(PDO $PDO, User $user)
    {
        $PDO->query('DELETE FROM PRODUCT WHERE userid = '. $user->getId());
        $PDO->query('DELETE FROM USER WHERE userid = '. $user->getId());
    }
}
