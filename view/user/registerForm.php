<?php require './view/includes/header.php';?>
    <div class="row col d-inline-flex justify-content-center align-items-center m-auto py-5 text-center">

        <div class="row">
            <h2>Sign Up</h2>
            <p>Please fill in this form to create an account</p>
        </div>
        <form action="?user&action=registerUser" method="post">
            <div class="form-group">
                <label>Username
                <input type="text" name="userName" placeholder="username" class="form-control  <?php echo (!empty($userName_err)) ? 'is-invalid' : ''; ?>" value="<?php if(isset($_POST['userName'])){echo $_POST['userName'];} ?>">
                <span class="invalid-feedback"><?php echo $userName_err; ?></span>
                </label>
            </div>
            <div class="form-group">
                <label>Email
                <input type="email" name="email" placeholder="name@gmail.com" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
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
            <input id="terms" type="checkbox" name="terms" class="<?php echo (!empty($terms_err)) ? 'is-invalid' : ''; ?>">
            <label for="terms">I agree to G-bay's <a href="?action=terms" target="_blank">Terms of use</a></label>
            <span class="invalid-feedback"><?php echo $terms_err; ?></span>
            </div>
            <div class="form-group">

                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="?login">Login here</a>.</p>
        </form>
    </div>

<?php require './view/includes/footer.php' ?>