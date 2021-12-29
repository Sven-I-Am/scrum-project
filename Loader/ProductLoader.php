<?php

class ProductLoader
{
    public static function readAllProducts(PDO $PDO){

        $database = $PDO->query("SELECT * FROM PRODUCT");
        $products = [];

        foreach($database as $key => $product){

            array_push($products, new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }

        return $products;

    }

}