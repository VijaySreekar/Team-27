<?php
session_start();
include '../AdminPage/AllFunctions/myfunctions.php';

$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $order_details = checkTrackingNo($tracking_no);
    if(mysqli_num_rows($order_details) == 0)
    {
        ?>
            <h4>No Orderss Found</h4>
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
    <title>
        Category Page
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Truncleta:wght@400&display=swap">

    <!-- Nucleo Icons -->
    <link href="../AdminPage/assets/nucleo-icons.css" rel="stylesheet" />
    <link href="../AdminPage/assets/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../AdminPage/assets/material-dashboard.min.css" rel="stylesheet" />

    <!-- SweetAlert2 CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../AdminPage/assets/js/custom.js"></script>

    <link rel="stylesheet" href="../ProductPage/product.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar">
        <div class="navbar-left">
            <div class="logo">
                <img src="../../Images/Treakers%20Logo.png" alt="Company Logo" class="logo-img">
            </div>
            <div class="navbar-center ml-5">
                <ul class="nav-links">
                    <li><a href="../../index.php">Home</a></li>
                    <li><a href="../ProductPage/products-page.php">Products</a></li>
                    <li><a href="../AboutUsPage/aboutus.php">About</a></li>
                    <li><a href="../ContactUsPage/contactus.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-right ml-3">
            <div class="buttons">
                <?php
                if(isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                    ?>
                    <div class="dropdown">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?>
                        </a>
                        <div class="dropdown-content">
                            <a href="other_pages/ProfilePage/profile.php">Your Profile</a>
                            <a href="../LoginPage/logout.php">Log out</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="nav-item">
                        <a class="nav-link" href="../LoginPage/login_page.php">
                            <i class="fas fa-user"></i> Login/Signup
                        </a>
                    </div>
                    <?php
                }
                ?>
                <a href="../BasketPage/basket.php" class="basket-link mr-3">
                    <button class="navbar-button">
                        <i class="fas fa-shopping-basket"></i>
                    </button>
                </a>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search" class="search-input">
                <button class="search-button"><i class="fas fa-search"></i></button>
            </div>
        </div>
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
                                                                    <img src="../AdminPage/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" style="width: 50px;">
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
                                                if($order_data['status'] == 0)
                                                {
                                                    echo "Order Placed";
                                                }else if($order_data['status'] == 1)
                                                {
                                                    echo "Order Shipped";
                                                }else if($order_data['status'] == 2)
                                                {
                                                    echo "Order Delivered";
                                                }else if($order_data['status'] == 3)
                                                {
                                                    echo "Order Cancelled";
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

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-col">
                    <h4>Treakers</h4>
                    <ul>
                        <li><a href="../AboutUsPage/aboutus.php">about us</a></li>
                        <li><a href="../ProductPage/products-page.php">our products</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="../ContactUsPage/contactus.php">Contact Us</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="../BasketPage/basket.php">Basket</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-col">
                    <h4>online shop</h4>
                    <ul>
                        <li><a href="../../index.php">Sneakers</a></li>
                        <li><a href="../../index.php">Trainers</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</main>
<script src="../AdminPage/assets/js/jquery-3.7.1.js"></script>
<script src="../AdminPage/assets/js/bootstrap.bundle.min.js"></script>
<script src="../AdminPage/assets/js/perfect-scrollbar.min.js"></script>
<script src="../AdminPage/assets/js/smooth-scrollbar.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
    </html><?php
