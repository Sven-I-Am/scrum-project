<?php require 'includes/header.php';?>
    <form action="?page=addProduct&action=create" method="post">

        <input type="text" name="name"> <span> <?php if(isset($errors['name'])) { echo $errors['name']; } ?> </span>
        <input type="text" name="description"> <?php if(isset($errors['description'])) { echo $errors['description']; } ?>
        <input type="text" name="price"> <?php if(isset($errors['price'])) { echo $errors['price']; } ?>
        <input type="text" name="image" > <?php if(isset($errors['image'])) { echo $errors['image']; } ?>


        <input type="submit" name="submit">

        <input type="submit" name="delete">
        <input type="submit" name="read">

    </form>
<?php require 'includes/footer.php';?>