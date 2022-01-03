<?php require 'includes/header.php';?>
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-4 g-4 ">

            <?php
            foreach ($products as $product) {
                if (!$product->getSold()){ 
            ?>
                    <form method='post' class='productCard p-2 mx-2 my-4 border border-4 border-dark' action="?home&action=buy">
                        <?php
                            component($product->getId(), $product->getImage(), $product->getName(), $product->getDescription(), $universes[$product->getUniverseId()-1]['name'], $categories[$product->getCategoryId()-1]['name'], $product->getCondition());
                            var_dump($product->getId());
                        ?>
                                <button type='submit' class='btn btn-outline-primary cardBtn' name="btnBuy" value="<?php echo $product->getId(); ?>">
                                    <p class='productPrice'><?php echo $product->getPrice(); ?> &euro;</p>
                                    <p class='productBuy'>Buy</p>
                                </button>
                            </div>
                        </div>
                    </form>
            <?php }} ?>
        </div>
    </div>
<?php require 'includes/footer.php' ?>