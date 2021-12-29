<?php require 'includes/header.php'?>
    <div class="row col d-inline-flex justify-content-center align-items-center m-auto py-5 text-center">
        <div class="row">
            <h2>Sign Up</h2>
            <p>Please fill in this form to create an account</p>
        </div>
        <form action="?user&action=registerUser" method="post">
            <div class="form-group">
                <label>Username
                <input type="text" name="userName" placeholder="username" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </label>
            </div>
            <div class="form-group">
                <label>Email
                <input type="email" name="email" placeholder="name@gmail.com" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
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
                <label>Confirm Password
                <input type="password" name="passwordRepeat" placeholder="confirm Password" class="form-control <?php echo (!empty($passwordRepeat_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $passwordRepeat_err; ?></span>
                </label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="?login">Login here</a>.</p>
        </form>
    </div>

<?php require 'includes/footer.php'?>