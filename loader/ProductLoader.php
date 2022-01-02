<?php

class ProductLoader
{
    //Create new product
    public static function createProduct(PDO $PDO, Product $product){
        $name = $product->getName();
        $condition = $product->getCondition();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $sold = 0;
        $image = $product->getImage();
        $userId = $product->getUserId();
        $sellDate = $product->getSellDate();
        $categoryId = $product->getCategoryId();
        $universeId = $product->getUniverseId();

        $stmt = $PDO->prepare('INSERT INTO PRODUCT(name, `condition`, description, price, sold, image,userid, selldate, categoryid, uid) VALUES(:name, :condition, :description, :price, :sold, :image, :userId, :sellDate, :categoryId, :universeId)');
        $stmt->execute([':name' => $name, ':condition' =>$condition, ':description' =>$description, ':price' => $price, ':sold' => $sold, ':image' => $image, ':userId' => $userId, ':sellDate' => $sellDate, ':categoryId' => $categoryId, ':universeId' => $universeId]);
        $stmt = null;
    }
    //Read all products
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
    //Read one product by id
    public static function readOneProduct(PDO $PDO, int $id): Product
    {
        $handler = $PDO->query("SELECT * FROM PRODUCT WHERE id = " . $id);
        $product = $handler->fetch();
        return new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']);
    }
    //Delete product based on id
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


}