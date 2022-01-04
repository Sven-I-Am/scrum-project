<?php

class UserLoader
{
    //Create new user
    public static function createUser(PDO $PDO, User $newUser): User
    {
        $userName = $newUser->getUserName();
        $email = $newUser->getEmail();
        $password = password_hash($newUser->getPassword(), PASSWORD_DEFAULT);

        $stmt = $PDO->prepare('INSERT INTO USER(username, email, password) VALUES(:userName,:email, :password)');
        $stmt->execute([':userName' => $userName, ':email' => $email, ':password' => $password]);
        $stmt = $PDO->prepare('SELECT * FROM USER WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        $stmt = null;
        return new User($user['userid'], $user['username'], $user['email'], $user['password']);
    }
    //Read one user aka login
    public static function readOne(PDO $PDO, User $checkUser): User | string
    {
        $userName = $checkUser->getUserName();
        $password = $checkUser->getPassword();

        $stmt = $PDO->prepare('SELECT * FROM USER WHERE username = :userName');
        $stmt->execute([':userName'=> $userName]);
        $response = $stmt->fetch();
        $stmt = null;
        if ($response){
            $user = new User($response['userid'], $response['username'], $response['email'], $response['password']);
            if(password_verify($password, $response['password']) && $user->checkOnline($PDO,$user->getId())==0){
                $user->setOnline($PDO, $user->getId());
                $return = $user;
            } else {
                $return = "The combination username & password is invalid, please check your input";
            }
        } else {
            $return = "The combination username & password is invalid, please check your input";
        }
        return $return;
    }

    //check for unique username
    public static function uniqueUser(PDO $PDO, string $userName){
        $stmt = $PDO->prepare('SELECT * FROM USER WHERE username = :userName');
        $stmt->execute([':userName' => $userName]);
        $return = $stmt->fetch();
        $stmt = null;
        return $return;
    }
    //check for unique email address
    public static function uniqueEmail(PDO $PDO, string $email){
        $stmt = $PDO->prepare('SELECT * FROM USER WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $return = $stmt->fetch();
        $stmt = null;
        return $return;
    }
    //Update user information
    public static function updateUser(PDO $PDO, User $oldUser, User $newUser): User
    {
        $id = $oldUser->getId();
        $userName = $newUser->getUserName();
        $email = $newUser->getEmail();

        $stmt = $PDO->prepare('UPDATE USER SET username = :userName, email = :email WHERE userid = :id');
        $stmt->execute([':userName' => $userName, ':email' => $email, ':id' => $id]);
        $stmt = $PDO->prepare('SELECT * FROM USER WHERE userid = :id');
        $stmt->execute([':id' => $id]);
        $updatedUser = $stmt->fetch();
        $stmt = null;
        return new User($updatedUser['userid'], $updatedUser['username'], $updatedUser['email'], $updatedUser['password']);
    }
    //Delete user account
    public static function deleteUser(PDO $PDO, User $user)
    {
        $stmt = $PDO->prepare('DELETE FROM PRODUCT WHERE userid = :id');
        $stmt->execute([':id' => $user->getId()]);
        $stmt = $PDO->prepare('DELETE FROM USER WHERE userid = :id');
        $stmt->execute([':id' => $user->getId()]);
        $stmt = null;
    }
   
}
