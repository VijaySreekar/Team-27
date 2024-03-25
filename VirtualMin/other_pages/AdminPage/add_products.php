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
                <div class="card-header">
                    <h4 class="card-title">Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="add_category_code.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-select">
                                <option selected disabled>Select Category</option>
                                <?php
                                $categories = getAll('category');
                                if(mysqli_num_rows($categories) > 0) {
                                    foreach($categories as $item) {
                                        echo "<option value='".$item['category_id']."'>".$item['name']."</option>";
                                    }
                                } else {
                                    echo "<option disabled>No Category Found</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" placeholder="Enter Slug" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="original_price">Original Price</label>
                                <input type="text" class="form-control" name="original_price" placeholder="Enter Original Price" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="discounted_price">Discounted Price</label>
                                <input type="text" class="form-control" name="discounted_price" placeholder="Enter Discounted Price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control-file" name="image" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="trending">Trending</label>
                                <select class="form-control" name="trending">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="addproduct_btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../Includes/admin_footer.php'; ?>
