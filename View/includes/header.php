<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    
    <!-- Local CSS link -->
    <link rel="stylesheet" href=".\View\style\style.css">
    <title>Pokeball Ecommerce website</title>
  </head>
  <body>
  <header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <img class="logo" src=".\assets\logo\pokeballLogo.png">
    <a class="navbar-brand mx-2 logoname" href="#">Pokeball</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="collapse navbar-collapse d-flex">

     <select class="nav-item dropdown mx-2" aria-label="Default select example">
     <option selected>Search by Category</option>
     <option value="card">Cards</option>
     <option value="toys">Toys</option>
     <option value="tshirt">T-Shirts</option>
     </select>
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
     <div class="mr-2">
     <a href="?page=login"><button class="btn btn-danger">Login</button></a>
          <!-- If we require Shopping-Cart -->
          <!-- <img src=".\assets\logo\cart.png" alt=""> -->
       </div>
     </div>
  </div>
</nav>
  </header>