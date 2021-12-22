<?php

declare(strict_types=1);

class User
{
    private int $id;
    private string $userName;
    private string $email;
    private string $password;

    public function __construct(int $id, string $userName, string $email, string $password)
    {
        $this->id = $id; //if empty = NULL
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    // get user id

    public function getId(): int
    {
        return $this->id;
    }

    // get and set userName

    public function getUserName(): string
    {
        return $this->userName;
    }
    public function setUserName(string $data)
    {
        $this->userName = $data;
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
}
