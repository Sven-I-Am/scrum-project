<?php require 'includes/header.php';?>

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
    <tr>
    <td>Pokemon</td>
      <td>its a soft toy</td>
      <td>99.99</td>
      <td><button type="submit" class="btn btn-outline-primary btn-sm">Cancel</button></td>
    </tr>
</tbody>
</table>
</div>
<div class="col">
<h4 class="cart1">Checkout</h4>
<form class="checkout" action="#" method="post">
  <div class="form-group ">
    <label for="exampleFormControlInput1" class="font-weight-bold">Email address:</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1" class="font-weight-bold">Address:</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="QueenPalace,antwerp" required>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1" class="font-weight-bold">Message to Seller:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="text-center">
  <button type="submit" class="btn btn-outline-primary btn-sm">Checkout</button>
</div>
</form>
</div>

<?php require 'includes/footer.php'?>