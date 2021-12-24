<?php

class ProductLoader{
   

    public static function readAllProducts(PDO $PDO){
        
        $products = $PDO->query("SELECT * FROM product");

        return ;

    }

    public static function createProduct(PDO $PDO, Product $product){

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $sold = $product->getSold();
        $image = $product->getImage();

        $PDO->query("INSERT INTO product (name, description, price, sold, image)
            VALUES ('$name', '$description', '$price', '$sold', '$image')");
    }

    public static function deleteProduct(PDO $PDO, int $id){
        
        $PDO->query("DELETE FROM product WHERE id = $id");

    }
}