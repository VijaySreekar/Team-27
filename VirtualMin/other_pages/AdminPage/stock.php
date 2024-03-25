<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';

// Define pagination variables
$records_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch products with pagination
$query = "SELECT * FROM product LIMIT $offset, $records_per_page";
$products_result = mysqli_query($conn, $query);

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h4 class="mb-0">Inventory Management</h4>
                </div>
                <div class="card-body" id="product_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Stock</th>
                            <th>Stock Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($products_result) > 0) {
                            while ($product = mysqli_fetch_assoc($products_result)) {
                                $stock = $product['quantity']; // Original stock from database
                                $productId = $product['product_id'];

                                // Adjust stock based on session cart
                                if (isset($_SESSION['cart'][$productId])) {
                                    $stock -= $_SESSION['cart'][$productId]['quantity'];
                                }

                                // Determine stock status
                                if ($stock <= 0) {
                                    $stockStatus = '<span class="badge bg-danger">Out of Stock</span>';
                                } elseif ($stock > 0 && $stock <= 50) {
                                    $stockStatus = '<span class="badge bg-warning text-dark">Low Stock</span>';
                                } else {
                                    $stockStatus = '<span class="badge bg-success">In Stock</span>';
                                }

                                // Display row
                                echo '<tr>';
                                echo '<td>' . $product['name'] . '</td>';
                                echo '<td><img src="../../Assets/Images/Product_Images/' . $product['image'] . '" width="50px" height="50px" alt="' . $product['name'] . '"></td>';
                                echo '<td>' . $stock . '</td>';
                                echo '<td>' . $stockStatus . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No products found!</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <?php
                    // Count total products
                    $total_query = "SELECT COUNT(*) as total FROM product";
                    $total_result = mysqli_query($conn, $total_query);
                    $total_row = mysqli_fetch_assoc($total_result);
                    $total_products = $total_row['total'];

                    // Calculate total pages
                    $total_pages = ceil($total_products / $records_per_page);

                    // Display pagination links
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
