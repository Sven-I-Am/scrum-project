<?php

declare(strict_types=1);

class User
{
    private int $userid;
   private string $username;
    private string $email;
    private string $password;

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

    // get and set userName

    public function getUserName(): string
    {
        return $this->username;
        
    }
    public function setUserName(string $data)
    {
        $this->username = $data;
    }

    // get and set user email

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $data)
    {
        $this->email = $data;
    }

    // get and set seller's password

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $data)
    {
        $this->password = $data;
    }

    public function checkOnline(PDO $PDO, int $id): string
    {
        $handler = $PDO->query('SELECT online FROM USER WHERE userid = ' . $id);
        $response = $handler->fetchAll();
        return $response[0]['online'];
    }

    public function setOnline(PDO $PDO, int $id)
    {
        $PDO->query('UPDATE USER SET online = true WHERE userid = ' . $id);
    }

    public function setOffline(PDO $PDO, int $id): bool
    {
        $PDO->query('UPDATE USER SET online = false WHERE userid = ' . $id);
    }
}
