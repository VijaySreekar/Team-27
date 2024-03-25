<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Functions/myfunctions.php';
include 'adminauth.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold fs-2">All Orders</span>
                    <a href="order_history.php" class="btn btn-info float-end">Order History</a>
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
                        $orders = getAllOrders();

                        if(mysqli_num_rows($orders) > 0)
                        {
                            foreach ($orders as $order)
                            {
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
                        }else
                        {
                            ?>
                            <tr>
                                <td colspan="5">No Orders Yet</td>
                            </tr>
                            <?php

                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../../Includes/admin_footer.php'; ?>


