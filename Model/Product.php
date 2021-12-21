<?php

declare(strict_types=1);

class Product {
    private string $id;
    private string $name;
    private float $price;
    private string $description;
    private string $status;
    private string $image;

    public function __construct(string $id, string $name, float $price, string $description, string $status, string $image){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->status = $status;
        $this->image = $image;
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

    // get and set product's price
    public function getPrice(){
        return $this->price;
    }

    public function setPrice(){
        $this->price;
    }

    // get and set product's description

    public function getDescription(){
        return $this->description;
    }

    public function setDescription(){
        $this->description;
    }

    // get and set product's status

    public function getStatus(){
        return $this->status;
    }

    public function setStatus(){
        $this->status;
    }

    // get and set product's image
    
    public function getImage(){
        return $this->image;
    }

    public function setImage(){
        $this->image;
    }

}
?>