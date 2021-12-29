<?php require 'includes/header.php'?>
    <div class="wrapper">
        <h2 class="title">Sign Up</h2>
        <p>Please fill this form to create an account</p>
        <?php
        if(!empty($register_err)){
            echo '<div class="alert alert-danger">' . $register_err . '</div>';
        }
        ?>

        <form action="?action=register" method="post">
            <div class="form-group">
                <label>Username
                <input type="text" name="userName" placeholder="username" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>">
                </label>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email
                <input type="email" name="email" placeholder="name@gmail.com" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
                </label>
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password
                <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </label>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password
                <input type="password" name="passwordRepeat" placeholder="confirm Password" class="form-control <?php echo (!empty($passwordRepeat_err)) ? 'is-invalid' : ''; ?>">
                </label>
                <span class="invalid-feedback"><?php echo $passwordRepeat_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="?page=login">Login here</a>.</p>
        </form>
    </div>

<?php require 'includes/footer.php'?>