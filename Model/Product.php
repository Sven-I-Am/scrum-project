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

    // get and set product's name

    public function getName(){
        return $this->name;
    }
    public function setName(string $name){
        $this->name = $name;
    }

    // get and set product's description

    public function getDescription(){
        return $this->description;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    // get and set product's price
    public function getPrice(){
        return $this->price;
    }

    public function setPrice(float $price){
        $this->price = $price;
    }

    // get and set product's sold

    public function getSold(){
        return $this->sold;
    }

    public function setSold(bool $sold){
        $this->sold = $sold;
    }

    // get and set product's image
    
    public function getImage(){
        return $this->image;
    }

    public function setImage(string $image){
        $this->image = $image;
    }

    // get and set product's userId

    public function getUserId(){
        return $this->userId;
    }

    // get and set product's sellDate

    public function getSellDate(){
        return $this->sellDate;
    }

    public function setSellDate(string $sellDate){
        return $this->sellDate = $sellDate;
    }
}
?>