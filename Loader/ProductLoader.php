<?php

class ProductLoader{
   

    public static function readAllProducts(PDO $PDO){
        
        $products = $PDO->query("SELECT * FROM product");

        foreach($products as $key => $product){

            var_dump($product['price']);

            return new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate']);
        }      

    }

    public static function createProduct(PDO $PDO, Product $product){

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $sold = $product->getSold();
        $image = $product->getImage();
        $userId = $product->getUserId();
        $sellDate = $product->getSellDate();


        $PDO->query("INSERT INTO product (name, description, price, sold, image, userid, selldate)
            VALUES ('$name', '$description', '$price', '$sold', '$image', '$userId', '$sellDate')");
    }

    public static function deleteProduct(PDO $PDO, int $id){
        
        $PDO->query("DELETE FROM product WHERE id = $id");

    }
}