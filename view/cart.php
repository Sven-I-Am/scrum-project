<!-- Local CSS link -->
<link rel="stylesheet" href="../view/style/style.css">
<?php require 'includes/header.php';?>


<div class="row">
<!-- <div class="cartBody"> -->
<div class="column">
<h5 class="cart">Your Selected Items</h5>

<table class=" test table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td>Pokemon</td>
      <td>its a soft toy</td>
      <td>99.99</td>
      <td><button type="submit" class="btn btn-outline-primary  btn-sm">Cancel</button></td>
    </tr>
    <tr>
    <td>Pokemon</td>
      <td>its a soft toy</td>
      <td>99.99</td>
      <td><button type="submit" class="btn btn-outline-primary  btn-sm">Cancel</button></td>
    </tr>
</tbody>
</table>
</div>
<!-- </div> -->
<!-- <div class="checkout"> -->
<div class="column">
<h5 class="cart">Checkout</h5>
<form class="checkout" action="#" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="queenPalace,antwerp">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Any Message to Seller</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-outline-primary  btn-sm">Checkout</button>
</form>
</div>
<!-- </div> -->


<?php require 'includes/footer.php' ?>