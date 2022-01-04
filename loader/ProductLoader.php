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
        $stmt = $PDO->prepare('SELECT * FROM PRODUCT WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $product = $stmt->fetch();
        return new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']);
    }

    public static function readAllProductByCondition(PDO $PDO, $condition)
    {
        $productsArray = [];
        $stmt = $PDO->prepare('SELECT * FROM PRODUCT WHERE `condition` = :condition AND sold = 0');
        $stmt->execute([':condition' => $condition]);
        $products = $stmt->fetchAll();        

        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }

        return $productsArray;      

    }

    public static function readAllProductByCategory(PDO $PDO, $categoryName)
    {
        $productsArray = [];

        $data = $PDO->prepare('SELECT * FROM CATEGORY WHERE name = :name');
        $data->execute([':name' => $categoryName]);
        $category = $data->fetch();
        $id = intval($category['id']);

        $stmt = $PDO->prepare('SELECT * FROM PRODUCT WHERE categoryid = :catId AND sold = 0');
        $stmt->execute([':catId' => $id]);
        $products = $stmt->fetchAll();        

        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }

        return $productsArray;      

    }

    public static function filterProducts(PDO $PDO, array $filter)
    {
        $productsArray=[];
        if(!empty($filter['universe'])){
            $stmt = $PDO->prepare('SELECT * FROM PRODUCT WHERE uid = :uid AND sold = 0');
            $stmt->execute([':uid' => $filter['universe']]);
        } elseif(!empty($filter['category'])) {
            $stmt = $PDO->prepare('SELECT * FROM PRODUCT WHERE categoryid = :cat AND sold = 0');
            $stmt->execute([':cat' => $filter['category']]);
        } elseif(!empty($filter['condition'])) {
            $stmt = $PDO->prepare('SELECT * FROM PRODUCT WHERE `condition` = :cond AND sold = 0');
            $stmt->execute([':cond' => $filter['condition']]);
        }
        $products = $stmt->fetchAll();
        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }
        return $productsArray;
    }

    //Update product
    public static function updateProduct(PDO $PDO, Product $product){
        $id = $product->getId();
        $name = $product->getName();
        $condition = $product->getCondition();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $image = $product->getImage();
        $categoryId = $product->getCategoryId();
        $universeId = $product->getUniverseId();

        $stmt = $PDO->prepare('UPDATE PRODUCT SET name = :name, `condition` = :condition, description = :description, price = :price, image = :image, categoryid = :catId, uid = :uid WHERE id = :id');
        $stmt->execute([':name' => $name, ':condition' => $condition, 'description' => $description, 'price' => $price, ':image' => $image, ':catId' => $categoryId, ':uid' => $universeId, ':id' => $id]);
        $stmt = null;
    }
    //Delete product based on id
    public static function deleteProduct(PDO $PDO, int $id){
        $stmt = $PDO->prepare("DELETE FROM PRODUCT WHERE id = :id");
        $stmt->execute([':id'=>$id]);
    }
    //search functionality
    public static function readAllProductByName(PDO $PDO, array $POST){
        $search ='%'.Sanitize::sanitizeInput($POST['search']).'%';
        $sql = "SELECT * FROM PRODUCT WHERE name LIKE :search or description LIKE :search";
        $stmt = $PDO->prepare($sql);
        $stmt->execute([':search'=>$search]);
        $products = $stmt->fetchAll();
        $productsArray = [];
        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }
        return $productsArray;
    }

    public static function readUserProducts(PDO $PDO, int $id, string $filter): array
    {
        switch ($filter){
            case 'all':
                $stmt = $PDO->prepare("SELECT * FROM PRODUCT WHERE userid = :id");
                break;
            case 'unsold':
                $stmt = $PDO->prepare("SELECT * FROM PRODUCT WHERE userid = :id AND sold = false");
                break;
            case 'sold':
                $stmt = $PDO->prepare("SELECT * FROM PRODUCT WHERE userid = :id AND sold = true");
                break;
        }
        $stmt->execute([':id' => $id]);
        $products = $stmt->fetchAll();
        $productsArray = [];
        foreach($products as $product){
            array_push($productsArray, new Product($product['id'], $product['name'], $product['condition'], $product['description'], $product['price'], $product['sold'], $product['image'], $product['userid'], $product['selldate'], $product['categoryid'], $product['uid']));
        }
        return $productsArray;
    }

    /* code for product set soldStatus */
    public static function updateSoldStatus(PDO $PDO, $id, $date, $status){
        $PDO->query("UPDATE PRODUCT SET sold = '$status', selldate = '$date' WHERE id = $id");
    }
}


    

