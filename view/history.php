<?php require 'includes/header.php'; ?>.
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
</div>
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-3 text-center">
    <table>
        <tr>
            <th class="py-3 border-3 border-dark">Date</th>
            <td class="py-3 border-3 border-dark"><?php echo Date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 6, date("Y"))); ?></td>
            <td class="py-3 border-3 border-dark"><?php echo Date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 5, date("Y"))); ?></td>
            <td class="py-3 border-3 border-dark"><?php echo Date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 4, date("Y"))); ?></td>
            <td class="py-3 border-3 border-dark"><?php echo Date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 3, date("Y"))); ?></td>
            <td class="py-3 border-3 border-dark"><?php echo Date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 2, date("Y"))); ?></td>
            <td class="py-3 border-3 border-dark"><?php echo Date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 1, date("Y"))); ?></td>
            <td class="py-3 border-3 border-dark"><?php echo Date("Y-m-d"); ?></td>
        </tr>
        <tr>
            <th class="py-3 border-3 border-dark">Average price</th>
            <td class="py-3 border-3 border-dark"><?php echo '0.00'; ?> &euro;</td>
            <td class="py-3 border-3 border-dark"><?php echo '0.00'; ?> &euro;</td>
            <td class="py-3 border-3 border-dark"><?php echo '0.00'; ?> &euro;</td>
            <td class="py-3 border-3 border-dark"><?php echo '0.00'; ?> &euro;</td>
            <td class="py-3 border-3 border-dark"><?php echo '0.00'; ?> &euro;</td>
            <td class="py-3 border-3 border-dark"><?php echo '0.00'; ?> &euro;</td>
            <td class="py-3 border-3 border-dark"><?php echo '0.00'; ?> &euro;</td>
        </tr>


    </table>
</div>
<?php require 'includes/footer.php'; ?>
