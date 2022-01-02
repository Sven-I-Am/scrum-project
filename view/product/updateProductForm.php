<?php require 'includes/header.php';?>
<div class="row col d-inline-flex justify-content-center align-items-center m-auto py-3 text-center">
    <div class="row">
        <h2>Update product</h2>
        <p>Please change the values in the form below to update your product posting</p>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <form action="?user&action=updateProduct" method="post">
                <div class="row form-group">
                    <div class="col">
                        <label for="pUni">Universe</label>
                        <select id="pUni" name="universe" class="form-control">
                            <?php forEach($universes as $universe) {?>
                                <option value="<?php echo $universe["id"]; ?>" <?php if($product->getUniverseId()==$universe['id']){echo 'selected';} ?>><?php echo $universe["name"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="pCat">Category</label>
                        <select id="pCat" name="category" class="form-control">
                            <?php forEach($categories as $category) {?>
                                <option value="<?php echo $category["id"]; ?>" <?php if($product->getCategoryId()==$category['id']){echo 'selected';} ?>><?php echo $category["name"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="pCon">Condition</label>
                        <select id="pCon" name="condition" class="form-control">
                            <option value="new" <?php if($product->getCondition() === 'new'){echo "selected";} ?>>New</option>
                            <option value="good" <?php if($product->getCondition() === 'good'){echo "selected";} ?>>Good</option>
                            <option value="used" <?php if($product->getCondition() === 'used'){echo "selected";} ?>>Used</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <label for="pName">Name <span class="formFinePrint text-muted">(max 25 characters)</span></label>
                        <input id="pName" maxlength="25" type="text" name="name" placeholder="productName" class="form-control  <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product->getName(); ?>">
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                    </div>
                    <div class="col">
                        <label for="pPrice">Price <span class="formFinePrint text-muted">(without currency symbol)</span></label>
                        <input id="pPrice" type="text" name="price" placeholder="9,99" class="form-control  <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product->getPrice(); ?>">
                        <span class="invalid-feedback"><?php echo $price_err; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pDescription">Description <span class="formFinePrint text-muted">(max 200 characters)</span></label>
                    <textarea id="pDescription" maxlength="200" name="description" placeholder="write a short description" class="form-control  <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $product->getDescription(); ?></textarea>
                    <span class="invalid-feedback"><?php echo $description_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="pUrl">Image url <span class="formFinePrint text-muted">(You can host your images with an outside provider such as dropbox)</span></label>
                    <input id="pUrl" type="text" name="url" placeholder="https://www.dropbox.com/..." class="form-control  <?php echo (!empty($url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product->getImage(); ?>">
                    <span class="invalid-feedback"><?php echo $url_err; ?></span>
                </div>

                <div class="form-group my-3">
                    <input class="productId" name="productId" value="<?php echo $_POST['productId']; ?>">
                    <button type="submit" name="save" class="btn btn-success">Save</button>
                    <button type="submit" name="cancel" class="btn btn-outline-danger">Cancel</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
<?php require 'includes/footer.php';?>
