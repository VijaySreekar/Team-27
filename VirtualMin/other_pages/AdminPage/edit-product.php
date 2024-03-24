<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
?>

<?php include '../../Includes/admin_header.php'; ?>

<div class="container">
    <?php
    if(isset($_SESSION['message'])):
        {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['message']);
        }
        ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $product = getProductItembyID('product', $id);

                    if(mysqli_num_rows($product) > 0)
                    {
                        $data = mysqli_fetch_array($product);
                        ?>
                            <div class="card">
                            <div class="card-header">
                                <h4>Edit Product
                                    <a href="allproducts.php" class="btn btn-primary float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="add_category_code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for=""> Category</label>
                                            <select name="category_id" class="form-select">
                                                <option selected>Select Category</option>
                                                <?php
                                                $categories = getAll('category');
                                                if(mysqli_num_rows($categories) > 0)
                                                {
                                                    foreach($categories as $item)
                                                    {
                                                        ?>
                                                        <option value="<?= $item['category_id']; ?>" <?= $data['category_id'] == $item['category_id']?'selected':'' ?>><?= $item['name']; ?></option>
                                                        <?php

                                                    }
                                                }
                                                else
                                                {
                                                    echo "<option>No Category Found</option>";
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="product_id" value="<?= $data['product_id']; ?>">
                                        <div class="col-md-12">
                                            <label class="mb-0">Name</label>
                                            <input type="text" required class="form-control mb-3" value="<?= $data['name']; ?>" name="name" placeholder="Enter Product Name">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0">Description</label>
                                            <textarea class="form-control mb-3" required name="description" placeholder="Enter Description"><?= $data['description']; ?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0">Original Price</label>
                                            <input type="text" class="form-control mb-3" required name="original_price" value="<?= $data['original_price']; ?>" placeholder="Enter Original Price">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0">Discounted Price</label>
                                            <input type="text" required class="form-control mb-3" name="discounted_price" value="<?= $data['discounted_price']; ?>" placeholder="Enter Discounted Price">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="category"> Upload Image</label>
                                            <input type="file" class="form-control" name="image">
                                            <label for="category"> Current Image</label>
                                            <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                            <img src="../../Assets/Images/Product_Images/<?= $data['image'] ?>" height="75px" width="75px" alt="">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="mb-0">Quantity</label>
                                                <input type="number" class="form-control mb-3" name="quantity" value="<?= $data['quantity']; ?>" placeholder="Enter Quantity">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="mb-0">Status</label>
                                                <select class="form-control mb-3" name="status" >
                                                    <option value="1" <?= ($data['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                                    <option value="0" <?= ($data['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="mb-0">Trending</label>
                                                <select class="form-control mb-3" name="popular">
                                                    <option value="1" <?= ($data['trending'] == 1) ? 'selected' : ''; ?>>Yes</option>
                                                    <option value="0" <?= ($data['trending'] == 0) ? 'selected' : ''; ?>>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type='submit' class="btn btn-primary mt-3" name="editproduct_btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo "Cannot find product with this ID!";
                    }

                }
                else
                    {
                        echo "Id is not set!";
                    }
                ?>
        </div>
    </div>
</div>
<?php include '../../Includes/admin_footer.php'; ?>

