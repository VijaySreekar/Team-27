<?php include 'Includes/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="add_category_code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="category">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Category Name">
                            </div>
                            <div class="col-md-6">
                                <label for="category">Slug</label>
                                <input type="text" class="form-control"  name="slug" placeholder="Enter Slug">
                            </div>
                            <div class="col-md-12">
                                <label for="category">Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="category">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="col-md-12">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title">
                            </div>
                            <div class="col-md-12">
                                <label for="meta_description">Meta Description</label>
                                <textarea rows="3" class="form-control" name="meta_description" placeholder="Enter Meta Description"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea rows="3" class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords"></textarea>
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
                                <button type='submit' class="btn btn-primary mt-3" name="add_categorybtn">Add Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Includes/Footer.php'; ?>


