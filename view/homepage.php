<?php require 'includes/header.php';?>

<div class=" productdisplay container my-4">
    <?php if(!empty($buy_err)){ ?>
        <div class="row border-danger border-4 text-center text-danger">
            <?php echo $buy_err; ?>
        </div>
    <?php } ?>
        <div class="row row-cols-1 row-cols-md-4 g-4 ">

            <?php
            foreach ($products as $product) {
                if (!$product->getSold()){ 
            ?>
                    <form method='post' class='productCard p-2 mx-2 my-4 border border-4 border-dark' action="?home&action=buy">
                        <?php
                            component($product->getId(), $product->getImage(), $product->getName(), $product->getDescription(), $universes[$product->getUniverseId()-1]['name'], $categories[$product->getCategoryId()-1]['name'], $product->getCondition(), $product->getUniverseId(), $product->getCategoryId());
                        ?>
                                <button type='submit' class='btn btn-outline-primary cardBtn'>
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