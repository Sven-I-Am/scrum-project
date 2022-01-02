<?php require 'includes/header.php';?>
<div class ='row title'>
    <h2>Hello <?php echo $user->getUserName(); ?></h2>
    <p>This is your account dashboard, you can change your username and email from here. Just change the values in the form below.</p>
    <p>You can also delete your account, but beware that this action can not be undone!</p>
</div>
<div class='row title'>
    <form method="post" action="?user&action=dashboard">
        <button type="submit" class="btn btn-primary my-4">Go to products</button>
    </form>
</div>
<div class='row dashFilter'>
    <form method="post">
            <button type="submit" name="deleteAccount" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete account</button>
    </form>
</div>
<div class='row col d-inline-flex justify-content-center align-items-center m-auto py-5 text-center'>
    <form method="post" action="?user&action=updateUser">
        <div class="form-group">
            <label>Username
                <input type="text" name="userName" placeholder="username" class="form-control  <?php echo (!empty($userName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['user']->getUserName(); ?>">
                <span class="invalid-feedback"><?php echo $userName_err; ?></span>
            </label>
        </div>
        <div class="form-group">
            <label>Email
                <input type="email" name="email" placeholder="name@gmail.com" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['user']->getEmail(); ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </label>
        </div>
        <div class="form-group">
            <label>Password
                <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </label>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </form>
</div>

<?php require 'includes/footer.php' ?>