<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
include 'adminauth.php';
?>

<?php include '../../Includes/admin_header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <?php
                if(isset($_SESSION['message'])):
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                endif;
                ?>
                <div class="card-header">
                    <h4>Edit Product
                        <a href="allproducts.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $product = getProductItembyID('product', $id);

                    if(mysqli_num_rows($product) > 0) {
                    $data = mysqli_fetch_array($product);
                    ?>
                    <form action="add_category_code.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-select">
                                <option selected>Select Category</option>
                                <?php
                                $categories = getAll('category');
                                if(mysqli_num_rows($categories) > 0) {
                                    foreach($categories as $item) {
                                        ?>
                                        <option value="<?= $item['category_id']; ?>" <?= $data['category_id'] == $item['category_id'] ? 'selected' : ''; ?>><?= $item['name']; ?></option>
                                        <?php
                                    }
                                } else {
                                    echo "<option>No Category Found</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="product_id" value="<?= $data['product_id']; ?>">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $data['name']; ?>" placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter Description" required><?= $data['description']; ?></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Original Price</label>
                                <input type="text" class="form-control" name="original_price" value="<?= $data['original_price']; ?>" placeholder="Enter Original Price" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Discounted Price</label>
                                <input type="text" class="form-control" name="discounted_price" value="<?= $data['discounted_price']; ?>" placeholder="Enter Discounted Price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" class="form-control-file" name="image">
                            <div>Current Image</div>
                            <img src="../../Assets/Images/Product_Images/<?= $data['image'] ?>" height="75px" width="75px" alt="">
                            <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="<?= $data['quantity']; ?>" placeholder="Enter Quantity">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?= ($data['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?= ($data['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-md -4">
                                <label>Trending</label>
                                <select class="form-control" name="popular">
                                    <option value="1" <?= ($data['trending'] == 1) ? 'selected' : ''; ?>>Yes</option>
                                    <option value="0" <?= ($data['trending'] == 0) ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary" name="editproduct_btn">Update</button>
                        </div>
                    </form>
                        <?php
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Cannot find product with this ID!</div>";
                    }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Id is not set!</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include '../../Includes/admin_footer.php'; ?>
