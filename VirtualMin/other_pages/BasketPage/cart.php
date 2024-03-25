<?php
session_start();
include '../../Assets/Functions/myfunctions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Your Cart</title>

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
            <a href="../BasketPage/cart.php" class="breadcrumbs__item is-active"><i class="bi bi-cart"></i> Cart</a>
        </nav>

        <div class="py-5 mb-12">
            <div class="container">
                <div class="card card-body shadow">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="MyCartItems" class="MyCartItems">
                                <h3 class="text-center">Your Cart</h3>
                            <?php
                                $items = myCartItems();

                                if(mysqli_num_rows($items)>0) {
                                    ?>
                                    <div id="MyCartItems" class="MyCartItems">
                                    <?php
                                    $items = myCartItems();
                                    if(mysqli_num_rows($items)>0)
                                    foreach ($items as $cartitem)
                                    {
                                    ?>
                                        <div class="card shadow-sm">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <img src="../../Assets/Images/Product_Images/<?= $cartitem['image'] ?>" alt="Product Image" width="100px">
                                                </div>
                                                <div class="col-md-3">
                                                    <h4><?= $cartitem['name'] ?></h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <h4>£<?= $cartitem['discounted_price'] ?></h4>
                                                </div>
                                                <div class="col-md-2" >
                                                    <input type="hidden" class="product_id" value="<?= $cartitem['product_id'] ?>">
                                                    <div class="input-group mb-3">
                                                        <h7 class="mr-3 mt-1">Quantity: </h7>
                                                        <input type="number" name="quantity" class="form-control updateQuantity" value="<?= $cartitem['quantity'] ?>" min="1" max="10">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger btn-sm deleteItem" value="<?= $cartitem['cid'] ?>"><i class="fa fa-trash"></i> Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <div class="float-end mt-4">
                                        <a href="checkout.php" class="btn btn-outline-primary">Proceed to Checkout</a>
                                    </div>
                                <?php
                                }else {
                                    ?>
                                    <div class="card card-body shadow text-center">
                                        <h4>Your cart is empty.</h4>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("../../Includes/footer.php"); ?>

    </main>
    <script src="../../Assets/JS/custom.js"></script>
    <script src="../../Assets/JS/jquery-3.7.1.js"></script>
    <script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
    <script src="../../Assets/JS/smooth-scrollbar.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>