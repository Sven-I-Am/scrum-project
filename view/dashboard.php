<?php require 'includes/header.php';?>
    <div class ='row title'>
        <h2>Hello <?php echo $_SESSION['user']->getUserName(); ?></h2>
        <p>This is your product dashboard, you can change postings, add postings and filter between sold and for sale.</p>
        <p>You can also delete products here, but beware that this action can not be undone!</p>
    </div>
    <div class='row title'>
        <form method="post" action="?user&action=dashboard&account">
            <button type="submit" class="btn btn-primary my-4">Go to account settings</button>
        </form>
    </div>
    <div class='row dashFilter'>
        <form method="post" action="?user&action=dashboard">
            <button type="submit" name="showAllProducts" class="btn btn-outline-dark">All products</button>
            <button type="submit" name="showUnsoldProducts" class="btn btn-outline-dark">Products for sale</button>
            <button type="submit" name="showSoldProducts" class="btn btn-outline-dark">Sold products</button>
        </form>
    </div>

    <!-- show only products of logged-in user -->
    <div class="container my-4">
    <div class="row row-cols-1 row-cols-md-4 g-4 ">
<?php
if(!empty($userProducts)){
    foreach ($userProducts as $product) { ?>
        <form method='post' action="?user&action=productChange" class='productCard p-2 mx-2 my-4 border border-4 border-dark'>
            <?php
            component($product->getId(), $product->getImage(), $product->getName(), $product->getDescription(), $universes[$product->getUniverseId()-1]['name'], $categories[$product->getCategoryId()-1]['name'], $product->getCondition(), $product->getUniverseId(), $product->getCategoryId());
            ?>


            <div class="row">
                <div class="w-50"><?php echo $product->getPrice(); ?> &euro;</div>
                <?php if(!$product->getSold()){ ?>
                    <button class="btn btn-primary w-25" type="submit" name="update">Update</button>
                    <button class="btn btn-danger w-25" type="submit" name="delete" onclick="return confirm('Are you sure?')">Delete</button>
                <?php } ?>
            </div>
        </div>
        </div>
        </form>
        <?php
    }
}?>
<?php if(!isset($_POST['showSoldProducts'])){ ?>
    <div class="productCard mx-2 my-4 border border-dark border-4 d-flex align-items-center justify-content-center">
        <form method="post" action="?user&action=addProduct">
            <button type="submit" name="addProduct" class="btn btn-outline-dark">Add product</button>
        </form>
    </div>
<?php } ?>
    </div>
    </div>
<?php require 'includes/footer.php' ?>