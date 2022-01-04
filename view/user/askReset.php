<?php require './view/includes/header.php' ?>
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-5 text-center">
    <div class="row">
        <h2>Reset password</h2>
        <p>Please enter your email address below.</p>
        <p>If an account is registered with the provided email address, an email will be sent including a link to reset your password.</p>
    </div>

    <form action="?user&action=askReset" method="post">
        <div class="form-group">
            <label>Email
                <input type="text" name="email" class="form-control" placeholder="example@domain.com">
            </label>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Send an email">
        </div>
        <p>Don't have an account? <a href="?user&action=register">Sign up now</a>.</p>
    </form>
</div>
<?php require './view/includes/footer.php' ?>
