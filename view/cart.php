
<?php require 'includes/header.php';?>
<!-- Local CSS link -->
<link rel="stylesheet" href="../view/style/style.css">

 <div class="Cart-Container"></div>
 <div class="Header">
 <h3 class="Heading">Shopping Cart</h3>
 <h5 class="Action">Remove all</h5>
 </div>

 <div class="Cart-Items">
 <div class="image-box">
 <?php require_once "home.php"; ?>
 </div>
 <div class="about">
 <h1 class="title">Name of Product</h1>
 <h3 class="subtitle">price</h3>
 <img src="images/veg.png" style={{ height=”30px” }}/>
 </div>
 <div class="counter"></div>
 <div class="prices"></div>
 </div>





<?php require '../view/includes/footer.php';?>