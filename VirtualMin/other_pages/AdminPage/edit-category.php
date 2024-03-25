<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
include 'adminauth.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$category = getItembyID('category', $id);
?>

<?php include '../../Includes/admin_header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <?php if ($category && mysqli_num_rows($category) > 0) {
                        $data = mysqli_fetch_array($category);
                        ?>
                        <form action="add_category_code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="category_id" value="<?= $data['category_id'] ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter Slug">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter Description"><?= $data['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload New Image</label>
                                <input type="file" class="form-control-file" name="image">
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                <img src="../../Assets/Images/Category_Images/<?= $data['image'] ?>" height="75px" width="75px" alt="">
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter Meta Title">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea rows="3" class="form-control" name="meta_description" placeholder="Enter Meta Description"><?= $data['meta_description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea rows="3" class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords"><?= $data['meta_keywords'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?= $data['status'] == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= $data['status'] == '0' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="popular">Popular</label>
                                <select class="form-control" name="popular">
                                    <option value="1" <?= $data['popular'] == '1' ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $data['popular'] == '0' ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="save_categorybtn">Update Category</button>
                            <a href="category.php" class="btn btn-secondary btn-block">Back</a>
                        </form>
                    <?php } else {
                        echo "Cannot find category with this ID!";
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../Includes/admin_footer.php'; ?>
