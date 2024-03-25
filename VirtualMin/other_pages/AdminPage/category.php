<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';
include 'adminauth.php';

// Pagination configuration
$records_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch categories with pagination
$query = "SELECT * FROM category LIMIT $offset, $records_per_page";
$categories_result = mysqli_query($conn, $query);

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Categories</h3>
                </div>
                <div class="card-body" id="category_table">
                    <?php
                    if (mysqli_num_rows($categories_result) > 0) {
                        ?>
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
                            while ($category = mysqli_fetch_assoc($categories_result)) {
                                ?>
                                <tr>
                                    <td><?= $category['category_id'] ?></td>
                                    <td><?= $category['name'] ?></td>
                                    <td>
                                        <img src="../../Assets/Images/Category_Images/<?= $category['image'] ?>" width="50px" height="50px" alt="<?= $category['name'] ?>">
                                    </td>
                                    <td>
                                        <?= $category['status'] == '1' ? "Visible" : "Hidden" ?>
                                    </td>
                                    <td>
                                        <a href="edit-category.php?id=<?= $category['category_id']; ?>" class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger delete_categorybtn" data-category_id="<?= $category['category_id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "<p>No categories found!</p>";
                    }
                    ?>

                    <!-- Pagination links -->
                    <?php
                    $total_query = "SELECT COUNT(*) as total FROM category";
                    $total_result = mysqli_query($conn, $total_query);
                    $total_row = mysqli_fetch_assoc($total_result);
                    $total_categories = $total_row['total'];
                    $total_pages = ceil($total_categories / $records_per_page);

                    if ($total_pages > 1) {
                        echo '<ul class="pagination justify-content-center">';
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../Includes/admin_footer.php'; ?>
