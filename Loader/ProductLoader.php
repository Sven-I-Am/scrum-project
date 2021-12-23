<?php

class ProductLoader{
   

    public static function readAllProducts(PDO $PDO){
        
        $product = $PDO->query("SELECT * FROM product");

        return $product['name'];

    }

    public static function createProduct(PDO $PDO, Product $product){

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $sold = $product->getSold();
        $image = $product->getImage();

        $PDO->query("INSERT INTO product (name, description, price, sold, image)
            VALUES ('$name', '$description', '$price', '$sold', '$image')");

            // var_dump($product->getName());
            // var_dump($product->getDescription());
            // var_dump($product->getPrice());
            // var_dump($product->getSold());
            // var_dump($product->getImage());
    }

}