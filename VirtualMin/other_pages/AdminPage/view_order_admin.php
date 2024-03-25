<?php
session_start();
include '../../Includes/admin_header.php';
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';
include 'adminauth.php';

if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $order_details = AdmincheckTrackingNo($tracking_no);
    if(mysqli_num_rows($order_details) == 0)
    {
        ?>
        <h4>No Orders Found</h4>
        <?php
        die();
    }

}
else
{
    ?>
    <h4>No Order Found</h4>
    <?php
    die();
}

$order_data = mysqli_fetch_array($order_details);
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header bg-primary">
                    <span class="text-white fs-2">View Order</span>
                    <a href="allorders.php" class="btn btn-dark-blue float-end">Back</a>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Delivery Details</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="fw-bold fs-5 mb-0">Name</label>
                                            <div class="border p-1">
                                                <?= $order_data['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold fs-5 mb-0">Email</label>
                                            <div class="border p-1">
                                                <?= $order_data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold fs-5 mb-0">Phone</label>
                                            <div class="border p-1">
                                                <?= $order_data['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold fs-5 mb-0">Tracking Number:</label>
                                            <div class="border p-1">
                                                <?= $order_data['tracking_no']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold fs-5 mb-0">Address</label>
                                            <div class="border p-1">
                                                <?= $order_data['address']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold fs-5 mb-0">Pin Code</label>
                                            <div class="border p-1">
                                                <?= $order_data['pincode']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>

                                    <table class="table text-center">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php

                                        $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.quantity as order_quantity, p.* FROM orders o, order_items oi, product p
                                                       WHERE oi.order_id = o.id AND p.product_id = oi.product_id AND o.tracking_no = '$tracking_no'";
                                        $order_items = mysqli_query($conn, $order_query);

                                        if(mysqli_num_rows($order_items) > 0)
                                        {
                                            foreach ($order_items as $item) {

                                            }
                                            ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="../../Assets/Images/Product_Images<?= $item['image']; ?>" alt="<?= $item['name']; ?>" style="width: 50px;">
                                                    <?= $item['name']; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $item['price']; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $item['order_quantity']; ?>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h4>Total Price: <span class="float-end">£<?= $order_data['total_price']; ?></span></h4>

                                    <label class="fw-bold fs-6 mb-1 mt-2">Payment Mode:</label>
                                    <div class="border p-3">
                                        <?= $order_data['payment_mode']; ?>
                                    </div>
                                    <label class="fw-bold fs-6 mb-1 mt-2">Order Status:</label>
                                    <div class="p-2">
                                        <form action="add_category_code.php" method="POST">
                                            <input type="hidden" name="tracking_no" value="<?= $order_data['tracking_no']; ?>">
                                            <select name="order_status" class="form-select">
                                                <option value="0" <?= $order_data['status'] == 0?"selected":"" ?>>Order Placed</option>
                                                <option value="1" <?= $order_data['status'] == 1?"selected":"" ?>>Order Shipped</option>
                                                <option value="2" <?= $order_data['status'] == 2?"selected":"" ?>>Order Delivered</option>
                                                <option value="3" <?= $order_data['status'] == 3?"selected":"" ?>>Order Cancelled</option>
                                            </select>
                                            <button type="submit" name='updateOrderButton' class="btn btn-primary mt-2">Update Status</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>