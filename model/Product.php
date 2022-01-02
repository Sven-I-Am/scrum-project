<?php

declare(strict_types=1);

class Product {
    private int $id;
    private string $name;
    private string $condition;
    private string $description;
    private float $price;
    private bool $sold;
    private string $image;
    private int $userId;
    private string $sellDate;
    private int $categoryId;
    private int $universeId;

    public function __construct(int $id, string $name, string $condition, string $description, float $price, bool $sold, string $image, int $userId, string $sellDate, int $categoryId, int $universeId){
        $this->id = $id;
        $this->name = $name;
        $this->condition = $condition;
        $this->description = $description;
        $this->price = $price;
        $this->sold = $sold;
        $this->image = $image;
        $this->userId = $userId;
        $this->sellDate = $sellDate;
        $this->categoryId = $categoryId;
        $this->universeId = $universeId;
    }

    // get id
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    // get and set product name
    public function getName(){
        return $this->name;
    }
    public function setName(string $name){
        $this->name = $name;
    }

    // get and set product condition
    public function getCondition(){
        return $this->condition;
    }
    public function setCondition(string $condition){
        $this->condition = $condition;
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
        $this->sellDate = $sellDate;
    }

    // get and set product's CategoryId

    public function getCategoryId(){
        return $this->categoryId;
    }

    // get and set product's UniverseId

    public function getUniverseId(){
        return $this->universeId;
    }
}