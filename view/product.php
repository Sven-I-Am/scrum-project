<?php require 'includes/header.php';?>
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-4 g-4 ">
            <?php foreach ($products as $product) {
                component($product->getImage(), $product->getName(), $product->getDescription(), $universes[$product->getUniverseId()]['name']);
            }
            ?>
        </div>
    </div>
<?php require 'includes/footer.php' ?>