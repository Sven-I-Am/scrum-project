<?php require 'includes/header.php' ?>
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-5 text-center">
    <div class="row">
        <h2>Login</h2>
        <p>Please fill in your credentials to login</p>
    </div>

    <form action="?login&action=login" method="post">
        <div class="form-group">
            <label>Username
            <input type="text" name="userName" class="form-control" placeholder="username">
            </label>
        </div>
        <div class="form-group">
            <label>Password
            <input type="password" name="password" class="form-control" placeholder="password">
            </label>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="?register">Sign up now</a>.</p>
    </form>
</div>
<?php require 'includes/footer.php'?>
