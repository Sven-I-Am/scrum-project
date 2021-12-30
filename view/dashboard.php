<?php require 'includes/header.php';?>
<div class ='row title'>
    <h2>Hello <?php echo $user->getUserName(); ?></h2>
</div>
    <div class='row title'>
        <a href="?user&action=dashboard&account"><button type="button" class="btn btn-primary my-4">Go to account settings</button></a>
    </div>
<div class='row dashFilter'>
    <form method="post" action="#">
            <button type="submit" value="showAllProducts" class="btn btn-outline-dark">All products</button>
            <button type="submit" value="showSaleProducts" class="btn btn-outline-dark">Products for sale</button>
            <button type="submit" value="showSoldProducts" class="btn btn-outline-dark">Sold products</button>
            <button type="submit" value="addProduct" class="btn btn-outline-dark">Add product</button>
    </form>
</div>

<!-- show only products of logged-in user -->
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-4 g-4 ">
            <?php
            if(!empty($_SESSION['userProducts'])){
            foreach ($_SESSION['userProducts'] as $product) { ?>
            <form method='post' action="?action=productChange" class='productCard p-2 mx-2 my-4 border border-4 border-dark'>
                <?php
                component($product->getId(), $product->getImage(), $product->getName(), $product->getDescription(), $universes[$product->getUniverseId()-1]['name'], $categories[$product->getCategoryId()-1]['name'], $product->getCondition());
                ?>


                <div class="row">
                    <div class="w-50"><?php echo $product->getPrice(); ?> &euro;</div>
                    <button class="btn btn-primary w-25" type="submit" name="update">Update</button>
                    <button class="btn btn-danger w-25" type="submit" name="delete" onclick="return confirm('Are you sure?')">Delete</button>
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