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
    public static function readOne(PDO $PDO, User $checkUser)
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

    public static function setToken(PDO $PDO, int $prehash, string $email): array
    {
        $token = password_hash($prehash, PASSWORD_DEFAULT);
        $stmt = $PDO->prepare('SELECT * FROM USER WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $response = $stmt->fetch();
        if($response){
            $userName = $response['username'];
            $id = $response['userid'];
            $stmt = $PDO->prepare('UPDATE USER SET token = :token WHERE userid = :id');
            $stmt->execute([':token' => $token, ':id' => $id]);
            return ['userName' => $userName, 'id' => $id];
        } else {
            return [];
        }
    }
    public static function resetPassword(PDO $PDO, User $user, string $token): string
    {
        $stmt = $PDO->prepare('SELECT * FROM USER WHERE email = :email');
        $stmt->execute([':email' => $user->getEmail()]);
        $response = $stmt->fetch();
        $stmt = null;
        if ($response) {
            if(password_verify($token, $response['token'])){
                $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $stmt = $PDO->prepare('UPDATE USER SET password = :password WHERE userid = :id');
                $stmt->execute([':password' => $password, ':id' => $response['userid']]);
                $stmt = $PDO->prepare('UPDATE USER SET token = null WHERE userid = :id');
                $stmt->execute([':id' => $response['userid']]);
                $stmt = null;
                return '';
            } else {
                return 'invalid token';
            }
        } else {
            return '';
        }
    }
}
