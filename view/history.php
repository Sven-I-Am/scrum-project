<?php require 'includes/header.php'; ?>.
<!-- show averaging price of product that were sold in the last 7 days -->
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-3 text-center">
    <div class="row">
        <h2>Check pricing history</h2>
        <p>Select the parameters below, press show and you should get a chart of the average sale prices for those products in the last 7 days.</p>
    </div>
    <div class="row">
        <form method="post" action="?action=historyFilter">
            <div class="form-group my-3">
            <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="universe">
                <?php forEach($universes as $universe) {?>
                    <option value="<?php echo $universe["id"]; ?>" <?php if(isset($_POST['universe']) && $_POST['universe'] == $universe['id']){ echo 'selected'; }?>><?php echo $universe["name"]; ?></option>
                <?php } ?>
            </select>
            <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="category">
                <?php forEach($categories as $category) {?>
                    <option value="<?php echo $category["id"]; ?>" <?php if(isset($_POST['category']) && $_POST['category'] == $category['id']){ echo 'selected'; }?>><?php echo $category["name"]; ?></option>
                <?php } ?>
            </select>
            <select class="nav-item dropdown mx-2 find" aria-label="Default select example" name="condition">
                <option value="new" <?php if(isset($_POST['condition']) && $_POST['condition'] === "new"){ echo 'selected'; }?>>new</option>
                <option value="good" <?php if(isset($_POST['condition']) && $_POST['condition'] === "good"){ echo 'selected'; }?>>good</option>
                <option value="used" <?php if(isset($_POST['condition']) && $_POST['condition'] === "used"){ echo 'selected'; }?>>used</option>
            </select>
            <button type="submit" name="showHistory" class="btn btn-success">Show</button>
            </div>
        </form>
    </div>
</div>
<?php if(!empty($filter)) {?>
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-3 text-center">
    <?php echo $universes[$filter['universe']-1]["name"] ?> -
    <?php echo $categories[$filter['category']-1]["name"] ?> -
    <?php echo $filter['condition'] ?>
</div>
<?php } ?>
<?php if(!empty($data)) { ?>
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-3 text-center">
    <table>
        <tr>
            <th class="py-3 border-3 border-dark">Date</th>
            <?php foreach($dates as $date){ ?>
            <td class="py-3 border-3 border-dark"><?php echo $date ?></td>
            <?PHP } ?>
        </tr>
        <tr>
            <th class="py-3 border-3 border-dark">Average price</th>
            <?php foreach($data as $price){
                if ($price == null) {
                    $price = '0';
                }
                ?>
            <td class="py-3 border-3 border-dark"><?php echo $price . ' &euro;'; ?></td>
            <?php } ?>
        </tr>


    </table>
</div>
<?php } ?>
<?php require 'includes/footer.php'; ?>
