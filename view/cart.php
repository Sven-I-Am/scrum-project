<?php require 'includes/header.php';?>
<?php if (!empty($success_msg)){ ?>
    <div class="alert alert-success" role="alert">
        <?php echo $success_msg; ?>
    </div>
<?php } else { ?>
    <div>
    </div>
<?php } ?>
<div class="row">
<div class="col">
<h4 class="cart">Your Selected Items</h4>

<table class=" test table table-bordered table-hover">
  <thead class="font-weight-bold">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  
  <tbody>
<!-- info come from database goes here  -->
<?php if(!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) { ?>

    <tr>
        <td><?php echo $product->getName(); ?></td>
        <td><?php echo $product->getDescription(); ?></td>
        <td><?php echo $product->getPrice(); ?> &euro;</td>
        <td><form method="post" action="?action=cancelPurchase"><button name="productId" type="submit" class="btn btn-danger btn-sm" value="<?php echo $product->getId(); ?>">Cancel</button></form></td>
    </tr>
<?php }} ?>
  <tr>
      <td>Total cart value:</td>
      <td></td>
      <td><?php echo $total; ?></td>
      <td></td>
  </tr>
</tbody>
</table>
</div>
<div class="col">
<h4 class="cart1">Checkout</h4>
<form class="checkout" action="?action=checkout" method="post">
  <div class="form-group ">
    <label for="exampleFormControlInput1" class="font-weight-bold">Email address: </label>
    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" id="exampleFormControlInput1" placeholder="name@example.com" required name="email">
    <span class="invalid-feedback"><?php echo $email_err; ?></span>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1" class="font-weight-bold">Message to Seller: <span class="formFinePrint text-primary font-weight-normal">(a default message will be sent automatically upon checkout)</span></label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
  </div>
  <div class="text-center">
  <button type="submit" class="btn btn-success btn-sm">Checkout</button>
</div>
</form>
</div>

<?php require 'includes/footer.php'?>