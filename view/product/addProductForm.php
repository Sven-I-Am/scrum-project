<?php require './view/includes/header.php';?>
    <div class="row col d-inline-flex justify-content-center align-items-center m-auto py-3 text-center">
        <div class="row">
            <h2>Add product</h2>
            <p>Please fill in this form to add a product</p>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <form action="?user&action=addProduct" method="post">
                    <div class="row form-group">
                        <div class="col">
                            <label for="pUni">Universe</label>
                            <select id="pUni" name="universe" class="form-control">
                                <?php forEach($universes as $universe) {?>
                                    <option value="<?php echo $universe["id"]; ?>"><?php echo $universe["name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="pCat">Category</label>
                            <select id="pCat" name="category" class="form-control">
                                <?php forEach($categories as $category) {?>
                                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="pCon">Condition</label>
                            <select id="pCon" name="condition" class="form-control">
                                <option value="new">New</option>
                                <option value="good">Good</option>
                                <option value="used">Used</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-5">
                            <label for="pName">Name <span class="formFinePrint text-muted">(max 25 characters)</span></label>
                            <input id="pName" maxlength="25" type="text" name="name" placeholder="productName" class="form-control  <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="col-5">
                            <label for="pPrice">Price <span class="formFinePrint text-muted">(without currency symbol)</span></label>
                            <input id="pPrice" type="text" name="price" placeholder="9.99" class="form-control  <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $price_err; ?></span>
                        </div>
                        <div class="col-2">
                            <label for="nrOfProds">Amount <span class="formFinePrint text-muted">(max 5)</span></label>
                            <input id="nrOfProds" type="number" min="1" max="5" placeholder="1" name="nrOf" class="form-control  <?php echo (!empty($nr_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $nr_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pDescription">Description <span class="formFinePrint text-muted">(max 200 characters)</span></label>
                        <textarea id="pDescription" maxlength="200" name="description" placeholder="write a short description" class="form-control  <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"></textarea>
                        <span class="invalid-feedback"><?php echo $description_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="pUrl">Image url <span class="formFinePrint text-muted">(You can host your images with an outside provider such as dropbox)</span></label>
                        <input id="pUrl" type="text" name="url" placeholder="https://www.dropbox.com/..." class="form-control  <?php echo (!empty($url_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $url_err; ?></span>
                    </div>

                    <div class="form-group my-3">
                        <button type="submit" name="save" class="btn btn-success">Save</button>
                        <button type="submit" name="cancel" class="btn btn-outline-danger">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
<?php require './view/includes/footer.php';?>