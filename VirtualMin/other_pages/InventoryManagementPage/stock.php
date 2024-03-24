<?php
session_start();
include 'Includes/admin_header.php';
include 'AllFunctions/myfunctions.php';

$products = getAll('product');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Inventory Management</h3>
                </div>
                <div class="card-body" id="product_table">
                    <?php
                    // Initialize array to store low stock items
                    $low_stock_items = array();

                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Stock Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(mysqli_num_rows($products) > 0) {
                                foreach ($products as $product) {
                                    // Set different stock levels for specific products
                                    $quantity = 50; // Default stock
                                    if ($product['product_id'] == 1 || $product['product_id'] == 2) {
                                        $quantity = 10; // Low stock for specific products
                                    }

                                    // Check if product is in cart and adjust stock accordingly
                                    if(isset($_SESSION['cart'][$product['product_id']])) {
                                        $stock -= $_SESSION['cart'][$product['product_id']]['quantity'];
                                    }

                                    // Determine stock status
                                    $stockStatus = '';
                                    if($quantity == 0) {
                                        $stockStatus = 'Out of Stock';
                                    } elseif($quantity<= 10) {
                                        $stockStatus = 'Low Stock';
                                        // Add low stock item to array
                                        $low_quantity_items[] = $product['name'];
                                    } else {
                                        $stockStatus = 'In Stock';
                                    }

                                    echo '<tr>';
                                    echo '<td>' . $product['name'] . '</td>';
                                    echo '<td><img src="' . $product['image'] . '" width="50px" height="50px" alt="' . $product['name'] . '"></td>';
                                    echo '<td>' . $quantity . '</td>';
                                    echo '<td>' . $stockStatus . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">No products found!</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    // Display alert for low stock items
                    if (!empty($low_quantity_items)) {
                        echo '<div class="alert alert-warning" role="alert">';
                        echo 'Low in stock items: ' . implode(', ', $low_quantity_items);
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'Includes/Footer.php'; ?>
<style>

.instock-status {
    background-color: #28a745; 
    color: #000; 
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
}
</style>
