<?php require 'includes/header.php'; ?>.
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-3 text-center">
    <div class="row">
        <h2>Check pricing history</h2>
        <p>Select the parameters below, press show and you should get a chart of the average sale prices for those products in the last 7 days.</p>
    </div>
    <div class="row">
        <form method="post" action="?historyFilter">
            <div class="form-group my-3">
            <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="universe">
                <?php forEach($universes as $universe) {?>
                    <option value="<?php echo $universe["id"]; ?>"><?php echo $universe["name"]; ?></option>
                <?php } ?>
            </select>
            <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="category">
                <?php forEach($categories as $category) {?>
                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                <?php } ?>
            </select>
            <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="condition">
                <option value="new">new</option>
                <option value="good">good</option>
                <option value="used">used</option>
            </select>
            <button type="submit" name="showHistory" class="btn btn-success">Show</button>
            </div>
        </form>
    </div>
<?php require 'includes/footer.php'; ?>
