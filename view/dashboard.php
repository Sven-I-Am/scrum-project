<?php require 'includes/header.php';?>
<div class="row details">
    <div class="col">
        <a href="#" class="product-info"><h5 >Sale Product</h5></a>
        <a href="#" class="product-info"><h5>Sold Product</h5></a>
        <a href="#" class="product-info"><h5>Add more items</h5></a>
    </div>
    <div class="col">
        <h2 class="title">Product Details</h2>
    </div>
    <div class="col">
        <a href="#" class="items"><h5>Delete Account</h5></a>
        <a href="#" class="items"><h5>Change Password</h5></a>
    </div>
</div>
<!-- show only products of logged-in user -->
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-4 g-4 ">
            <?php foreach ($userProducts as $product) {
                component($product->getId(), $product->getImage(), $product->getName(), $product->getDescription(), $universes[$product->getUniverseId()-1]['name'], $categories[$product->getCategoryId()-1]['name'], $product->getCondition());
            ?>

                        <button type='submit' class='btn btn-outline-primary cardBtn'>
                            <p class='productPrice'><?php echo $product->getPrice(); ?> &euro;</p>
                            <p class='productBuy'>Buy</p>
                        </button>
                    </div>
                </div>
            </form>
            <?php }?>
        </div>
    </div>
<form action="#" method="post">
<div class="container mt-5 dashboard">
    <div class="row row-cols-1 row-cols-md-4 g-4">
      
        <div class="col">
          <div class="card h-auto border border-2 border-dark">
            <img src=".\assets\screenshots\poke.jpg" class="card-img-top">
           </div>
        </div>
     
       <div class="col mx-0">
        <div class="card border border-2 border-dark description">
          <div class="card-body">
           <h5 class="card-title">Name:<?php $ProductName ?></h5>
           <h5 class="card-title">Price:<?php $ProductPrice ?></h5>
           <p class="card-text">Product description:<?php $ProductDescription ?></p>
            <div class="d-grid d-md-flex justify-content-between">
            <button class="btn btn-primary me-md-2" type="button">Update</button>
            <button class="btn btn-primary" type="button">Delete</button>
            </div>
         </div>
        </div>
       </div>
    </div> 
</div> 
</form>
<?php require 'includes/footer.php' ?>