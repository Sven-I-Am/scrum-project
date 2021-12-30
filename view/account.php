<?php require 'includes/header.php';?>
<div class ='row title'>
    <h2>Hello <?php echo $user->getUserName(); ?></h2>
</div>
<div class='row title'>
    <a href="?user&action=dashboard&products"><button type="button" class="btn btn-primary my-4">Go to products</button></a>
</div>
<div class='row dashFilter'>
    <form method="post" action="#">
            <button type="submit" value="changeAccount" class="btn btn-outline-dark">Change account settings</button>
            <button type="submit" value="deleteAccount" class="btn btn-outline-dark">Delete account</button>
    </form>
</div>

<?php require 'includes/footer.php' ?>