
<?php
require ("./Helper/Sanitize.php");
    
    if(isset($_POST) && isset($_POST['submit'])){
        $product = new TestController();
        $data = $product->createProduct();
        if(isset($data['status']) && $data['status'] == 'error') {
            $errors = $data['errors'];
        }
    }
    
?>

<form method="post">

<input type="text" name="name">  <?php if(isset($errors['name'])) { echo $errors['name']; } ?>" 
<input type="text" name="description"> <?php if(isset($errors['description'])) { echo $errors['description']; } ?>
<input type="text" name="price"> <?php if(isset($errors['price'])) { echo $errors['price']; } ?>
<input type="text" name="image" > <?php if(isset($errors['image'])) { echo $errors['image']; } ?>

<input type="submit" name="submit">

<input type="submit" name="delete">
<input type="submit" name="read">

</form>
