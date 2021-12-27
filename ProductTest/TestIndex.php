
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

<input type="text" name="name" style= <?php if(isset($errors['name']))  { echo "'border-red-500 focus:border-red-000'>".$errors['name']; } ?>
<input type="text" name="description" class="<?php if(isset($errors['description'])) { echo $errors['description']. 'border-red-500 focus:border-red-000'; } else { echo 'border-gray-300 focus:border-blue-400'; } ?>" >
<input type="text" name="price" class="<?php if(isset($errors['price'])) { echo $errors['price']. 'border-red-500 focus:border-red-000'; } else { echo 'border-gray-300 focus:border-blue-400'; } ?>" >
<input typr="text" name="image" class="<?php if(isset($errors['image'])) { echo $errors['image']. 'border-red-500 focus:border-red-000'; } else { echo 'border-gray-300 focus:border-blue-400'; } ?>" >

<input type="submit" name="submit">

<input type="submit" name="delete">
<input type="submit" name="read">

</form>
