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

    public static function readOneProduct(PDO $PDO, int $id): Product
    {
        $handler = $PDO->query("SELECT * FROM PRODUCT WHERE id = " . $id);
        $product = $handler->fetchAll();
        return new Product($product[0]['id'], $product[0]['name'], $product[0]['condition'], $product[0]['description'], $product[0]['price'], $product[0]['sold'], $product[0]['image'], $product[0]['userid'], $product[0]['selldate'], $product[0]['categoryid'], $product[0]['uid']);
    }

    public static function deleteProduct(PDO $PDO, int $id){
        $PDO->query("DELETE FROM PRODUCT WHERE id = $id");
    }

    public static function readUserProducts(PDO $PDO, int $id, string $filter): array
    {
        switch ($filter){
            case 'all':
                $handler = $PDO->query("SELECT * FROM PRODUCT WHERE userid = " . $id);
                break;
            case 'unsold':
                $handler = $PDO->query("SELECT * FROM PRODUCT WHERE userid = " . $id . " AND sold = false");
                break;
            case 'sold':
                $handler = $PDO->query("SELECT * FROM PRODUCT WHERE userid = " . $id . " AND sold = true");
                break;
        }
        $products = $handler->fetchAll();
        $productsArray = [];
        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }
        return $productsArray;
    }

    public static function createProduct(PDO $PDO, Product $product){
        echo 'ok';
    }
}