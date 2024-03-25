<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';
include 'adminauth.php';

// Define variables for pagination
$records_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Get search term if provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch products with pagination
$query = "SELECT * FROM product";
if (!empty($searchTerm)) {
    $query .= " WHERE name LIKE '%$searchTerm%'";
}
$query .= " LIMIT $offset, $records_per_page";
$product = mysqli_query($conn, $query);

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Products</h3>
                </div>
                <div class="card-body" id="product_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($product) > 0) {
                            while ($item = mysqli_fetch_assoc($product)) {
                                ?>
                                <tr>
                                    <td><?= $item['product_id'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td>
                                        <img src="../../Assets/Images/Product_Images/<?= $item['image'] ?>" width="50px" height="50px" alt="<?= $item['name'] ?>">
                                    </td>
                                    <td>
                                        <?= $item['status'] == '1' ? "Visible" : "Hidden" ?>
                                    </td>
                                    <td>
                                        <a href="edit-product.php?id=<?= $item['product_id']; ?>" class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger deleteproduct_btn" data-product_id="<?= $item['product_id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>No products found!</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <?php
                    $total_query = "SELECT COUNT(*) as total FROM product";
                    if (!empty($searchTerm)) {
                        $total_query .= " WHERE name LIKE '%$searchTerm%'";
                    }
                    $total_result = mysqli_query($conn, $total_query);
                    $total_row = mysqli_fetch_assoc($total_result);
                    $total_products = $total_row['total'];
                    $total_pages = ceil($total_products / $records_per_page);

                    if ($total_pages > 1) {
                        ?>
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&search=<?= $searchTerm ?>"><?= $i ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../Includes/admin_footer.php'; ?>
