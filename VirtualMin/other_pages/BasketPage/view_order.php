<?php
session_start();
include '../../Assets/Functions/myfunctions.php';

include "../../Assets/Database/connectdb.php";
if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $order_details = checkTrackingNo($tracking_no);
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View Order</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Truncleta:wght@400&display=swap">
    <link rel="stylesheet" href="../../Assets/CSS/nav.css">

    <!-- Nucleo Icons -->
    <link href="../../Assets/CSS/nucleo-icons.css" rel="stylesheet" />
    <link href="../../Assets/CSS/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../../Assets/CSS/material-dashboard.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="../../Assets/CSS/nav.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <?php include("../../Includes/nav.php"); ?>

    <nav class="breadcrumbs">
        <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
        <a href="../ProfilePage/profile.php" class="breadcrumbs__item"><i class="bi bi-person"></i> Profile</a>
        <a href="../BasketPage/my_orders.php" class="breadcrumbs__item"><i class="bi bi-clock-history"></i> Order History</a>
        <a href="#" class="breadcrumbs__item is-active"><i class="bi bi-bag-check"></i> Order Details</a>
    </nav>

    <div class="py-5">
        <div class="container">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-gradient-secondary">
                                <span class="text-white fs-3"> Order Details</span>
                                <a href="my_orders.php" class="btn btn-primary float-end"><i class="fa fa-reply"></i> Back</a>
                            </div>
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

                                                $user_id = $_SESSION['auth_user']['user_id'];
                                                $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.quantity as order_quantity, p.* FROM orders o, order_items oi, product p
                                                       WHERE o.user_id = '$user_id' AND oi.order_id = o.id AND p.product_id = oi.product_id AND o.tracking_no = '$tracking_no'";
                                                $order_items = mysqli_query($conn, $order_query);

                                                if(mysqli_num_rows($order_items) > 0)
                                                {
                                                    foreach ($order_items as $item) {

                                                    }
                                                        ?>
                                                            <tr>
                                                                <td class="align-middle">
                                                                    <img src="../../Assets/Images/Product_Images/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" style="width: 50px;">
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
                                        <div class="border p-3">
                                            <?php
                                            if ($order_data['status'] == 0) {
                                                echo "Order Placed";
                                            } else if ($order_data['status'] == 1) {
                                                echo "Order Shipped";
                                            } else if ($order_data['status'] == 2) {
                                                echo "Order Delivered";
                                                ?>
                                                <!-- Return Order Button -->
                                                <form action="return_order.php" method="post">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($order_data['id']); ?>">
                                                    <button type="submit" name="return_button" class="btn btn-danger">Return Order</button>
                                                    <input type="hidden" name="tracking_no" value="<?= $tracking_no ?>">
                                                </form>
                                                <?php
                                            } else if ($order_data['status'] == 3) {
                                                echo "Order Cancelled";
                                            } else if ($order_data['status'] == 4) {
                                                echo "Order Returned";
                                            }
                                            ?>
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

    <?php include("../../Includes/footer.php"); ?>

</main>
<script src="../../Assets/JS/jquery-3.7.1.js"></script>
<script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
<script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
<script src="../../Assets/JS/smooth-scrollbar.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
