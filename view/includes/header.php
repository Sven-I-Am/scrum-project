<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Local CSS link -->
    <link rel="stylesheet" href="./view/style/style.css">
    <title>Gbay Ecommerce website</title>
</head>
<body>
    <header>
  <!-- navigation bar starts here  -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <img class="logo"src=".\assets\logo\pokeballLogo.png">
                <a class="navbar-brand mx-2 logoname" data-toggle="tooltip" data-placement="bottom" title="Home" href="?home">
                Gbay</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="collapse navbar-collapse d-flex" action='?home&action=search' method = "post">
                        <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="category">
                        <option value="0" selected>All categories</option>

                        <!-- access category type from category table in database -->

                        <?php forEach($categories as $category) {?>
                            <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                        <?php } ?>
                        </select>
                        <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="universe">
                            <option value="0" selected>All universes</option>

                        <!-- access universe type from universe table in database -->

                            <?php forEach($universes as $universe) {?>
                                <option value="<?php echo $universe["id"]; ?>"><?php echo $universe["name"]; ?></option>
                            <?php } ?>
                        </select>
                        <input class="form-control me-2" type="search" name ="search" placeholder="Search" aria-label="Search">

                        <button class="btn btn-outline-success" name = "submit" type="submit">Search</button>
                    </form>


                    <div class="mr-2">
            <!-- if user session is not set make it login button else make it logout  -->
                        
                        <?php if(!isset($_SESSION['user'])) { ?>
                            <a href="?user"><button class="btn btn-danger">Login</button></a>
                           
                            <!-- <a href="?user&action=register"><button class="btn btn-primary">Register</button></a> -->
                            <a href="?user&action=register"> <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Please register to sell products">Register</button></a>
                        <?php } else { ?>
                            <a href="?user&action=logout"><button class="btn btn-danger">Logout</button></a>
                            <a href="?user&action=dashboard"><button class="btn btn-primary">Dashboard</button></a>
                        <?php } ?>
                    </div>
                    <div>
                        <!--Shopping-Cart -->
                        <?php if(empty($_SESSION['cart'])){ ?>
                            <a href="?action=cart"><i class="bi bi-cart" data-toggle="tooltip" data-placement="bottom" title="Shopping Cart"></i></a>
                        <?php }else{?>
                            <a href="?action=cart"><i class="bi bi-cart-fill"></i></a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<main>