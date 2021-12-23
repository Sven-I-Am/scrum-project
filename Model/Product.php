<?php

declare(strict_types=1);

class Product {
    private string $id;
    private string $name;
    private string $description;
    private float $price;
    private bool $sold;
    private string $image;
    private int $userId;
    private string $sellDate;

    public function __construct(string $id, string $name, string $description, float $price, bool $sold, string $image, int $userId, string $sellDate){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->sold = $sold;
        $this->image = $image;
        $this->userId = $userId;
        $this->sellDate = $sellDate;
    }

    // get and set product's id

    public function getId(){
        return $this->id;
    }

    public function setId(){
        $this->id;
    }

    // get and set product's name

    public function getName(){
        return $this->name;
    }
    public function setName(){
        $this->name;
    }

    // get and set product's description

    public function getDescription(){
        return $this->description;
    }

    public function setDescription(){
        $this->description;
    }

    // get and set product's price
    public function getPrice(){
        return $this->price;
    }

    public function setPrice(){
        $this->price;
    }

    // get and set product's sold

    public function getSold(){
        return $this->status;
    }

    public function setSold(){
        $this->status;
    }

    // get and set product's image
    
    public function getImage(){
        return $this->image;
    }

    public function setImage(){
        $this->image;
    }

    // get and set product's userId

    public function getUserId(){
        return $this->userId;
    }

    public function setUserId(){
        return $this->userId;
    }

    // get and set product's sellDate

    public function getSellDate(){
        return $this->sellDate;
    }

    public function setSellDate(){
        return $this->sellDate;
    }
}
?>