<?php
session_start();
include '../../Assets/Database/connectdb.php';
include '../../Assets/Functions/myfunctions.php';

// Assuming getUserDetails() is a function that fetches user details from the database
if (!isset($_SESSION['auth_user'])) {
    header('Location: ../LoginPage/login_page.php');
    exit;
}

$user_id = $_SESSION['auth_user']['user_id'];
$user_details = getUserDetails($user_id);
$recent_orders = getViewRecentOrders($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link href="../../Assets/CSS/material-dashboard.min.css" rel="stylesheet">
    <link href="../../Assets/CSS/nav.css" rel="stylesheet">
</head>
<body class="g-sidenav-show bg-gray-200">

<?php include("../../Includes/nav.php"); ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Breadcrumbs -->
    <nav class="breadcrumbs">
        <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
        <a href="#" class="breadcrumbs__item is-active"><i class="bi bi-person"></i> Profile</a>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body shadow">
                    <h3>Hi there, <?= htmlspecialchars($user_details['username']); ?></h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card card-header">
                                    <h4>Your Details</h4>
                                </div>
                                <div class="card card-body">
                                    <p><strong>Email:</strong> <?= htmlspecialchars($user_details['email']); ?></p>
                                    <p><strong>Phone:</strong> <?= htmlspecialchars($user_details['phone']); ?></p>
                                    <a href='edit_user.php?updateid=<?= $user_id; ?>' class="btn btn-primary">Edit Details</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8 mt-0">
                            <div class="card">
                                <div class="card card-header">
                                    <h4>Your Recent Orders</h4>
                                </div>
                                <div class="card card-body">
                                    <?php if (!empty($recent_orders)): ?>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total Price</th>
                                                <th>Review</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($recent_orders as $order): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($order['id']); ?></td>
                                                    <td><?= date("F j, Y, g:i a", strtotime($order['created_at'])); ?></td>
                                                    <td>
                                                        <?php
                                                        switch ($order['status']) {
                                                            case 0: echo "Order Placed"; break;
                                                            case 1: echo "Order Shipped"; break;
                                                            case 2: echo "Order Delivered"; break;
                                                            case 3: echo "Order Cancelled"; break;
                                                            default: echo "Unknown Status"; break;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>£<?= htmlspecialchars($order['total_price']); ?></td>
                                                    <td>
                                                        <a href="../ReviewPage/review.php?orderId=<?= $order['id']; ?>" class="btn btn-primary">Leave a Review</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <p>No recent orders found.</p>
                                    <?php endif; ?>
                                    <a href="../BasketPage/my_orders.php" class="btn btn-primary">View All Orders</a>
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

<!-- Include Bootstrap JS and other necessary JavaScript libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
<script src="../../Assets/JS/smooth-scrollbar.min.js"></script>

</body>
</html>

