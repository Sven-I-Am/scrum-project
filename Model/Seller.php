<?php

declare(strict_types=1);

class Seller
{
    private string $id;
    private string $name;
    private string $adress;
    private string $email;
    private string $password;

    public function __construct(string $id, string $name, string $adress, string $email, string $password){
        $this->id = $id;
        $this->name = $name;
        $this->adress = $adress;
        $this->email = $email;
        $this->password = $password;
    }

    // get and set seller's id

    public function getId(){
        return $this->id;
    }

    public function setId(){
        $this->id;
    }

    // get and set seller's name

    public function getName(){
        return $this->name;
    }
    public function setName(){
        $this->name;
    }

    // get and set seller's adress
    public function getAdress(){
        return $this->adress;
    }

    public function setAdress(){
        $this->adress;
    }

    // get and set seller's email

    public function getEmail(){
        return $this->email;
    }

    public function setEmail(){
        $this->email;
    }

    // get and set seller's password

    public function getPassword(){
        return $this->password;
    }

    public function setPassword(){
        $this->password;
    }

}
