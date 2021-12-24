<?php require 'includes/header.php';
      require 'component.php';
?>

<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<link rel="stylesheet" href=".\View\style\style.css">
<div class="container my-4">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            component();
            component();
            component();
            component();
            component();
            component();
            component();
            component();
           ?>
        </div>
</div> 
            
<?php require 'includes/footer.php' ?>