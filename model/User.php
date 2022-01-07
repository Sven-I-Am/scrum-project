<?php

declare(strict_types=1);

class User
{
    private $userid;
   private $username;
    private $email;
    private $password;

    public function __construct(int $userid, string $username, string $email, string $password)
    {
        $this->userid = $userid; //if empty = NULL
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // get user id

    public function getId(): int
    {
        return $this->userid;
    }

    // get userName

    public function getUserName(): string
    {
        return $this->username;
        
    }
    // set userName
    public function setUserName(string $data)
    {
        $this->username = $data;
    }

    // get user email

    public function getEmail(): string
    {
        return $this->email;
    }
    // set user email
    public function setEmail(string $data)
    {
        $this->email = $data;
    }

    // get seller's password

    public function getPassword(): string
    {
        return $this->password;
    }
    //set seller's password
    public function setPassword(string $data)
    {
        $this->password = $data;
    }
    // check if the user is online
    public function checkOnline(PDO $PDO, int $id): int
    {
        $handler = $PDO->query('SELECT online FROM USER WHERE userid = ' . $id);
        $response = $handler->fetch();
        return intval($response['online']);
    }
    // save in user table from database the user is online
    public function setOnline(PDO $PDO, int $id)
    {
        $PDO->query('UPDATE USER SET online = true WHERE userid = ' . $id);
    }
    // save in user table from database the user is offline
    public function setOffline(PDO $PDO, int $id)
    {
        $PDO->query('UPDATE USER SET online = false WHERE userid = ' . $id);
    }
}
