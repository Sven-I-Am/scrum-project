<<<<<<< HEAD
<?php require 'includes/header.php'?>
=======
<?php require 'includes/header.php' ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
>>>>>>> b5391a253ae750a6b08cbfd5294524083c0bb0a3
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="?page=login&action=register" method="post">
            <div class="form-group">
                <label>Username</label>
<<<<<<< HEAD
                <input type="text" name="userName" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
=======
                <input type="text" name="userName" class="form-control">
            </div>    
>>>>>>> b5391a253ae750a6b08cbfd5294524083c0bb0a3
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>    

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
<<<<<<< HEAD
                <input type="password" name="passwordRepeat" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
=======
                <input type="password" name="passwordRepeat" class="form-control">
>>>>>>> b5391a253ae750a6b08cbfd5294524083c0bb0a3
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="?page=login">Login here</a>.</p>
        </form>
<<<<<<< HEAD
    </div>

<?php require 'includes/footer.php'?>
=======
    </div>    
</body>
</html>
>>>>>>> b5391a253ae750a6b08cbfd5294524083c0bb0a3
