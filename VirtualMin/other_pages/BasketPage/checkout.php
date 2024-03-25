<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Checkout</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Truncleta:wght@400&display=swap">
    <link rel="stylesheet" href="../../Assets/CSS/nav.css">
    <!-- SweetAlert2 CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <a href="../ProductPage/category_page.php" class="breadcrumbs__item"><i class="bi bi-list"></i> Categories</a>
        <a href="../BasketPage/cart.php" class="breadcrumbs__item"><i class="bi bi-cart"></i> Cart</a>
        <a href="../AboutUsPage/aboutus.php" class="breadcrumbs__item is-active"><i class="bi bi-bag-check"></i> Checkout</a>
    </nav>

    <div class="py-5">
        <div class="container">
            <div class="card">
                <div class="card-body shadow">
                    <form action="placeorder.php" method="POST">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Order Summary</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="name"  id="name" required class="form-control" placeholder="Enter your Full Name">
                                        <small class="text-danger name"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" id="email" required class="form-control" placeholder="Enter your Email">
                                        <small class="text-danger email"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Phone Number</label>
                                        <input type="text" name="phone" id="phone" required class="form-control" placeholder="Enter your Phone Number">
                                        <small class="text-danger phone"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Pin Code</label>
                                        <input type="text" name="pincode" id="pincode" required class="form-control" placeholder="Enter your Pin Code">
                                        <small class="text-danger pincode"></small>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold">Address</label>
                                        <textarea name="address" id="address" class="form-control" required rows='4' placeholder="Enter your Address"></textarea>
                                        <small class="text-danger address"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h4>Order Details</h4>
                                <?php $items = myCartItems();
                                $totalPrice = 0;
                                foreach ($items as $cartitem)
                                {
                                    ?>
                                    <div class="card mb-3 border-0">
                                        <div class="row align-items-center g-0">
                                            <div class="col-md-4">
                                                <img src="../../Assets/Images/Product_Images/<?= $cartitem['image'] ?>" alt="Product Image" class="img-fluid rounded-start" style="max-height: 100px;">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body py-2">
                                                    <h6 class="card-title mb-1"><?= $cartitem['name'] ?></h6>
                                                    <p class="card-text mb-0">Quantity: <?= $cartitem['quantity'] ?>   Price: £<?= $cartitem['discounted_price'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $totalPrice += $cartitem['discounted_price'] * $cartitem['quantity'];
                                }
                                ?>
                                <h5 class="mt-3">Total: <span class="float-end" id="totalPrice">£<?= $totalPrice?></span></h5>
                                <input type="hidden" name="payment_mode" value="Card">
                                <button type='submit' name="placeOrderButton" class="btn btn-primary mt-3 w-100" id="placeOrder">Place Order</button>
                                <div id="paypal-button-container">

                                </div>
                            </div>
                        </div>
                    </form>
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
<script src="../../Assets/JS/custom.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AUco1UA8mfq_-Mhe_7lZV1TVQeiJbmp0PB11-pn-YPm3XVwrCLqkIRmTYMzz_AoxoRYDHY9AilI4liPd&currency=GBP"></script>
<script>

    paypal.Buttons({
        onClick: function() {

            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var pincode = $('#pincode').val();
            var address = $('#address').val();

            if(name.length == 0)
            {
                $('.name').text('*Please fill out this field');
            }else {
                $('.name').text('');
            }
            if(email.length == 0)
            {
                $('.email').text('*Please fill out this field');
            }
            else {
                $('.email').text('');
            }
            if(phone.length == 0)
            {
                $('.phone').text('*Please fill out this field');
            }
            else {
                $('.phone').text('');
            }
            if(pincode.length == 0)
            {
                $('.pincode').text('*Please fill out this field');
            }
            else {
                $('.pincode').text('');
            }
            if(address.length == 0)
            {
                $('.address').text('*Please fill out this field');
            }
            else {
                $('.address').text('');
            }

            if(name.length == 0 || email.length == 0 || phone.length == 0 || pincode.length == 0 || address.length == 0)
            {
                return false;
            }
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $totalPrice ?>'
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                const transaction = orderData.purchase_units[0].payments.captures[0];

                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var pincode = $('#pincode').val();
                var address = $('#address').val();


                var data = {
                    'name' : name,
                    'email' : email,
                    'phone' : phone,
                    'pincode' : pincode,
                    'address' : address,
                    'payment_mode' : 'Paypal',
                    'payment_id' : transaction.id,
                    'placeOrderButton' : true
                };

                $.ajax({
                    method: 'POST',
                    url: 'placeorder.php',
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            title: 'Order Placed!',
                            text: 'Your order has been placed successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '../ProfilePage/profile.php';
                        });
                    },
                })
            });
        }
    }).render('#paypal-button-container');

</script>
</body>
</html>