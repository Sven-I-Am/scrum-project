<?php
Class Deatils{
    public static function searchProduct(PDO $PDO, Product $Product): Product
{
if (isset($_POST['submit'])) {
    $name = $_POST['search'];

    $sql = 'SELECT * FROM Product WHERE name = :name';
    $stmt = $PDO->prepare($sql);
    $stmt->execute(['name' => $name]);
    $row = $stmt->fetch();
  } else {
    header('location: helper/component.php');
    exit();
  }
}
}
