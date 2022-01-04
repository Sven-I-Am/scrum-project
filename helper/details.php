<?php
Class Deatils{
    public static function searchProduct(PDO $PDO, Product $Product): Product
{
if (isset($_POST['submit'])) {
    $name = $_POST['search'];

    $sql = 'SELECT * FROM Product WHERE `name` = :name';
    $stmt = $PDO->prepare($sql);
    $stmt->execute(['name' => $name]);
    var_dump($stmt);
    $row = $stmt->fetchAll();
  } else {
    header('location: ');
    exit();
  }

}
}
?>


<div class="container">
    <div class="row mt-5">
      <div class="col-5 mx-auto">
        <div class="card shadow text-center">
          <div class="card-header">
            <h1><?php $name ?></h1>
          </div>
          <div class="card-body">
            <h4><b>Description :</b> <?php $description ?></h4>
            <h4><b>name :</b> <?php $name ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>


