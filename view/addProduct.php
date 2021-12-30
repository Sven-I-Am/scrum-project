<?php require 'includes/header.php';?>
    <div class="row col d-inline-flex justify-content-center align-items-center m-auto py-5 text-center">
        <div class="row">
            <h2>Add product</h2>
            <p>Please fill in this form to add a product</p>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form action="?user&action=addProduct" method="post">
                    <div class="row form-group">
                        <div class="col">
                            <label for="pName">Name <p class="formFinePrint">(max 50 characters)</p></label>
                            <input id="pName" type="text" name="productName" placeholder="productName" class="form-control  <?php echo (!empty($errors['name'])) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $errors['name']; ?></span>
                        </div>
                        <div class="col">
                            <label for="pPrice">Price <p class="formFinePrint">(without currency symbol)</p></label>
                            <input id="pPrice" type="number" min="0" name="productDescription" placeholder="9,99" class="form-control  <?php echo (!empty($errors['price'])) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $errors['price']; ?></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <label for="pCat">Category</label>
                            <select id="pCat" name="productCat" class="form-control">
                                <?php forEach($categories as $category) {?>
                                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="pUni">Universe</label>
                            <select id="pUni" name="productCat" class="form-control">
                                <?php forEach($universes as $universe) {?>
                                    <option value="<?php echo $universe["id"]; ?>"><?php echo $universe["name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description <p class="formFinePrint">(max 200 characters)</p></label>
                        <textarea maxlength="200" name="productDescription" placeholder="write a short description" class="form-control  <?php echo (!empty($errors['description'])) ? 'is-invalid' : ''; ?>"></textarea>
                        <span class="invalid-feedback"><?php echo $errors['description']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Image url <p class="formFinePrint">(You can host your images with an outside provider such as dropbox)</p></label>
                        <input type="number" min="0" name="productDescription" placeholder="https://www.dropbox.com/..." class="form-control  <?php echo (!empty($errors['price'])) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $errors['price']; ?></span>
                    </div>

                    <div class="form-group my-3">
                        <button type="submit" name="save" class="btn btn-success">Save</button>
                        <button type="submit" name="cancel" class="btn btn-outline-danger">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
<?php require 'includes/footer.php';?>