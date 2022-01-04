<?php 
require '.env';
require 'model/Connection.php';
require 'View/header.php';
$name = "";

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $pdoquery = "SELECT * FROM PRODUCT WHERE id = :id";
   $result = PDO->prepare($pdoquery);
   $exec = $result->execute(array(":id=>$id"));
if($exec){
 foreach($result as $row){
     $name = $row['name'];
     
 }
}
else{
    echo "Error Data not found";
}
}
    // gets value sent over search form

    $min_length = 3;
    // you can set minimum length of the query if you want

    if(mb_strlen($keyword) >= $min_length){ 
     
     $stmt = $db->prepare(" MATCH (name, description, price) AGAINST (:keyword)");
    $stmt->execute(array(':keyword'=>$keyword));
    while($res = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        echo $row['name'];
         echo $row['description'];
          echo $row['price'];
    }
}
 else {
        echo 'Cant find! ';
    }
 ?>
