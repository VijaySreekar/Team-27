<?php
session_start();
include 'Includes/header.php';
include 'AllFunctions/myfunctions.php';
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Categories</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Category Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categories = getAll('category');

                            if(mysqli_num_rows($categories) > 0)
                            {
                                foreach ($categories as $category) {
                                    ?>
                                    <tr>
                                        <td><?= $category['category_id'] ?></td>
                                        <td><?= $category['name'] ?></td>
                                        <td>
                                            <img src="<?= $category['image'] ?>" width="50px" height="50px" alt="<?= $category['name'] ?>">
                                        </td>
                                        <td>
                                            <?= $category['status'] == '1' ? "Visible" : "Hidden" ?>
                                        </td>
                                        <td>
                                            <a href="edit-category.php?id=<?= $category['category_id']; ?>"  class="btn btn-primary">Edit</a>
                                            <form action="add_category_code.php" method="POST">
                                                <input type="hidden" name="category_ids" value="<?= $category['category_id'] ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_categorybtn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                echo "No categories found!";
                            }
                            ?>
                            <tr>
                        </tbody>
                    </table>

    </div>
</div>
<?php include 'Includes/Footer.php'; ?>


