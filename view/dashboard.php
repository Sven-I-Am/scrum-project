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
            <?php
            if(!empty($userProducts)){
            foreach ($userProducts as $product) { ?>
            <form method='post' class='productCard p-2 mx-2 my-4 border border-4 border-dark'>
                <?php
                component($product->getId(), $product->getImage(), $product->getName(), $product->getDescription(), $universes[$product->getUniverseId()-1]['name'], $categories[$product->getCategoryId()-1]['name'], $product->getCondition());
                ?>

                <div><?php echo $product->getPrice(); ?> &euro;</div>
                <div class="row">
                    <a href="?updateProduct&id=<?php echo $product->getId(); ?>"><button class="btn btn-primary me-md-2" type="button">Update</button></a>
                    <button class="btn btn-primary" type="submit">Delete</button>
                </div>
                </div>
                </div>
            </form>
            <?php
                }
            } else { ?>
                <h3>You have no products for sale, <a href="?action=addProduct">add one now!</a></h3>
            <?php } ?>
        </div>
    </div>
<?php require 'includes/footer.php' ?>