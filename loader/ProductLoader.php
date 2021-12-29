<?php

class ProductLoader
{
    public static function readAllProducts(PDO $PDO): array
    {
        $handler = $PDO->query("SELECT * FROM PRODUCT");
        $products = $handler->fetchAll();
        $productsArray = [];
        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }
        return $productsArray;
    }

    public static function readUserProducts(PDO $PDO, int $id): array
    {
        $handler = $PDO->query("SELECT * FROM PRODUCT WHERE userid = " . $id);
        $products = $handler->fetchAll();
        $productsArray = [];
        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }
        return $productsArray;
    }
}