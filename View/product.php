<?php require 'includes/header.php';
require 'component.php';
?>

    <!-- this is the view, try to put only simple if's and loops here.
    Anything complex should be calculated in the model -->
    <link rel="stylesheet" href=".\View\style\style.css">
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-4 g-4 ">
            <?php
            component(".\assets\screenshots\poke.jpg","New","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","Pokemon","toy","$299");
            component(".\assets\screenshots\poke.jpg","Good","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","HarryPoter","Shirt","$99.99");
            component(".\assets\screenshots\poke.jpg","New","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","Pokemon","card","$99");
            component(".\assets\screenshots\poke.jpg","Used","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","Pokemon","card","$199");
            component(".\assets\screenshots\poke.jpg","New","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","HarryPoter","Shirt","$199");
            component(".\assets\screenshots\poke.jpg","Good","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","Pokemon","toy","$99");
            component(".\assets\screenshots\poke.jpg","Used","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","Marvel","shirt","$99");
            component(".\assets\screenshots\poke.jpg","New","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.","Pokemon","card","$99");
            ?>
        </div>
    </div>

<?php require 'includes/footer.php' ?>