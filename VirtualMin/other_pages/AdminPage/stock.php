<?php
session_start();
include 'Includes/header.php';
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
                            if(mysqli_num_rows($products) > 0) {
                                foreach ($products as $product) {
                                    $stock = 100; 
                                    $stockStatus = 'In Stock'; 
                                    

                                    if(isset($_SESSION['cart'][$product['product_id']])) {
                                        $stock -= $_SESSION['cart'][$product['product_id']]['quantity'];
            
                                        if($stock == 0) {
                                            $stockStatus = 'Out of Stock';
                                        } elseif($stock <= 50) {
                                            $stockStatus = 'Low Stock';
                                        }
                                    }

                                    echo '<tr>';
                                    echo '<td>' . $product['name'] . '</td>';
                                    echo '<td><img src="' . $product['image'] . '" width="50px" height="50px" alt="' . $product['name'] . '"></td>';
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