<?php
session_start();
include 'AllFunctions/myfunctions.php';
?>

<?php include 'Includes/header.php'; ?>

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
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
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
                                                <option value="<?= $item['category_id']; ?>"><?= $item['name']; ?></option>
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
                            <div class="col-md-12">
                                <label class="mb-0">Name</label>
                                <input type="text" required class="form-control mb-3" name="name" placeholder="Enter Category Name">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Description</label>
                                <textarea class="form-control mb-3" required name="description" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Original Price</label>
                                <input type="text" class="form-control mb-3" required name="original_price" placeholder="Enter Original Price">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Discounted Price</label>
                                <input type="text" required class="form-control mb-3" name="discounted_price" placeholder="Enter Discounted Price">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0"> Upload Image</label>
                                <input type="file" class="form-control mb-3" name="image">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="mb-0">Quantity</label>
                                    <input type="number" class="form-control mb-3" name="quantity" placeholder="Enter Quantity">
                                </div>
                                <div class="col-md-4">
                                    <label class="mb-0">Status</label>
                                    <select class="form-control mb-3" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="mb-0">Trending</label>
                                    <select class="form-control mb-3" name="popular">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type='submit' class="btn btn-primary mt-3" name="addproduct_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Includes/Footer.php'; ?>