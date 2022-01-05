<?php require './view/includes/header.php' ?>
    <div class="row col d-inline-flex justify-content-center align-items-center m-auto py-5 text-center">
        <div class="row">
            <h2>Reset your password</h2>
            <p>Fill out the form below to reset your password</p>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form action="?user&action=reset" method="post">
                    <div class="form-group">
                        <label for="email">email <span class="formFinePrint">(address this link was sent to)</span></label>
                        <input id="email" type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="example@domain.com"  value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">New password</label>
                        <input id="password" type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="password">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="repeatPassword">Repeat new password</label>
                        <input id="repeatPassword" type="password" name="passwordRepeat" class="form-control" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="token">Validation code <span class="formFinePrint">(this was sent to your inbox along with this link)</span></label>
                        <input id="token" type="text" name="token" class="form-control <?php echo (!empty($token_err)) ? 'is-invalid' : ''; ?>" placeholder="123456" value="<?php if(isset($_POST['token'])){echo $_POST['token'];} ?>">
                        <span class="invalid-feedback"><?php echo $token_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                        <input name='userId' value='<?php echo $id; ?>' class='productId'>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
<?php require './view/includes/footer.php' ?>