<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
include 'adminauth.php';
?>

<?php include '../../Includes/admin_header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $category = getItembyID('category', $id);

                    if(mysqli_num_rows($category) > 0)
                    {
                        $data = mysqli_fetch_array($category);
                        ?>
                            <div class="card">
                            <div class="card-header">
                                <h4>Edit Category
                                    <a href="category.php" class="btn btn-primary float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="add_category_code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="category_id" value="<?= $data['category_id'] ?>">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category">Slug</label>
                                            <input type="text" class="form-control"  name="slug" value="<?= $data['slug'] ?>" placeholder="Enter Slug">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="category">Description</label>
                                            <textarea class="form-control" name="description" placeholder="Enter Description"><?= $data['description'] ?>"</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="category"> Upload Image</label>
                                            <input type="file" class="form-control" name="image">
                                            <label for="category"> Current Image</label>
                                            <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                            <img src="../../Assets/Images/Category_Images/<?= $data['image'] ?>" height="75px" width="75px" alt="">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter Meta Title">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea rows="3" class="form-control" name="meta_description" placeholder="Enter Meta Description"><?= $data['meta_description'] ?>"</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <textarea rows="3" class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords"><?= $data['meta_keywords'] ?>"</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="popular">Popular</label>
                                            <select class="form-control" name="popular">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <button type='submit' class="btn btn-primary mt-3" name="save_categorybtn">Update Category</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo "Cannot find category with this ID!";
                    }
                }
                else
                {
                    echo "Cannot find ID from the URL!";
                }
            ?>
        </div>
    </div>
</div>
<?php include '../../Includes/admin_footer.php'; ?>


