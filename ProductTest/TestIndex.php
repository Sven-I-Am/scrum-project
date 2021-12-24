
<form method="post">

<input type="text" name="name" <?php if(isset($errors['name'])) { echo 'border-red-500 focus:border-red-000'; } else { echo 'border-gray-300 focus:border-blue-400'; } ?> >
<input type="text" name="description" <?php if(isset($errors['description'])) { echo 'border-red-500 focus:border-red-000'; } else { echo 'border-gray-300 focus:border-blue-400'; } ?> >
<input type="text" name="price" <?php if(isset($errors['price'])) { echo 'border-red-500 focus:border-red-000'; } else { echo 'border-gray-300 focus:border-blue-400'; } ?> >
<input typr="text" name="image" <?php if(isset($errors['image'])) { echo 'border-red-500 focus:border-red-000'; } else { echo 'border-gray-300 focus:border-blue-400'; } ?> >

<input type="submit" name="submit">

<input type="submit" name="delete">
<input type="submit" name="read">

</form>
