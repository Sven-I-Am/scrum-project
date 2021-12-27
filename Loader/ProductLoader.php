<?php

class ProductLoader{
   

    public static function readAllProducts(PDO $PDO){
        
        $database = $PDO->query("SELECT * FROM PRODUCT");
        $products = [];

        foreach($database as $key => $product){

            array_push($products, new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate']));

        }      
        
        return $products;

    }

    public static function createProduct(PDO $PDO, Product $product){

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $sold = $product->getSold();
        $image = $product->getImage();
        $userId = $product->getUserId();
        $sellDate = $product->getSellDate();


        $PDO->query("INSERT INTO PRODUCT (name, description, price, sold, image, userid, selldate)
            VALUES ('$name', '$description', '$price', '$sold', '$image', '$userId', '$sellDate')");
    }

    public static function deleteProduct(PDO $PDO, int $id){
        
        $PDO->query("DELETE FROM PRODUCT WHERE id = $id");

    }
}