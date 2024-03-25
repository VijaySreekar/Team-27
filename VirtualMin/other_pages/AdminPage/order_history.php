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

// Fetch order history with pagination
$query = "SELECT * FROM orders ORDER BY created_at DESC LIMIT $offset, $records_per_page";
$orders_result = mysqli_query($conn, $query);

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold fs-2">Order History</span>
                    <a href="allorders.php" class="btn btn-info float-end"><i class="fa fa-back"></i> Back</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>OrderID</th>
                            <th>User</th>
                            <th>Tracking No</th>
                            <th>Price</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($orders_result) > 0) {
                            while ($order = mysqli_fetch_assoc($orders_result)) {
                                ?>
                                <tr>
                                    <td><?= $order['id']; ?></td>
                                    <td><?= $order['name']; ?></td>
                                    <td><?= $order['tracking_no']; ?></td>
                                    <td><?= $order['total_price']; ?></td>
                                    <td><?= $order['created_at']; ?></td>
                                    <td><a href="view_order_admin.php?t=<?= $order['tracking_no']; ?>" class="btn btn-primary">View Details</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">No Orders Yet</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <?php
                    $total_query = "SELECT COUNT(*) as total FROM orders";
                    $total_result = mysqli_query($conn, $total_query);
                    $total_row = mysqli_fetch_assoc($total_result);
                    $total_orders = $total_row['total'];
                    $total_pages = ceil($total_orders / $records_per_page);

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
