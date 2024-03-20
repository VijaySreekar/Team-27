<?php

session_start();
include '../AdminPage/AllFunctions/myfunctions.php';

if(isset($_GET['product']))
{

    $product_slug = $_GET['product'];
    $product_data = getSlugActive('product', $product_slug);
    $product = mysqli_fetch_assoc($product_data);

    if($product)
    {
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

                <!--    <link rel="stylesheet" type="text/css" href="productstyles.css">-->
                <link rel="stylesheet" href="../NavBar/nav.css">

                <!-- Nucleo Icons -->
                <link href="../AdminPage/assets/nucleo-icons.css" rel="stylesheet" />
                <link href="../AdminPage/assets/nucleo-svg.css" rel="stylesheet" />
                <!-- Font Awesome Icons -->
                <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
                <!-- Material Icons -->
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
                <!-- CSS Files -->
                <link id="pagestyle" href="../AdminPage/assets/material-dashboard.min.css" rel="stylesheet" />

                <!-- Alertify JS -->
                <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
                <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>


                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Truculenta:opsz,wght@12..72,100..900&display=swap');

                    *, h1 {
                        font-family: 'Roboto', sans-serif;
                        font-weight: 700;
                    }

                    .form-control {
                        border: 1px solid #b3a1a1 !important;
                        padding: 8px 10px;
                    }
                    .form-select {
                        border: 1px solid #b3a1a1 !important;
                        padding: 8px 10px;
                    }
                    .navbar {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        font-size: larger;
                    }

                    .navbar-left {
                        display: flex;
                        align-items: center;
                    }

                    .navbar-right {
                        display: flex;
                        align-items: center;
                    }

                    .logo-img {
                        max-width: 100px; /* Adjust the max-width according to your preference */
                        height: auto;
                    }

                    .nav-links {
                        list-style-type: none;
                        padding: 0;
                        margin: 0;
                        display: flex;
                        font-size: larger;
                    }

                    .nav-links li {
                        margin-right: 20px; /* Adjust spacing between links */
                    }

                    .nav-link {
                        font-size: 20px; /* Adjust font size */
                        padding: 15px 25px; /* Adjust padding */
                    }

                    .nav-links li a {
                        text-decoration: none;
                        color: #000; /* Adjust link color */
                    }

                    .buttons {
                        display: flex;
                        align-items: center;
                    }

                    .dropdown {
                        position: relative;
                        margin-right: 20px; /* Adjust spacing between dropdown and basket */
                    }

                    .dropdown-content {
                        display: none;
                        position: absolute;
                        background-color: #f9f9f9;
                        min-width: 120px;
                        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                        z-index: 1;
                    }

                    .dropdown-content a {
                        color: black;
                        padding: 12px 16px;
                        text-decoration: none;
                        display: block;
                    }

                    .dropdown:hover .dropdown-content {
                        display: block;
                    }

                    .search-bar {
                        display: flex;
                        align-items: center;
                    }

                    .search-input {
                        padding: 8px;
                        border-radius: 4px;
                        border: 1px solid #ccc;
                        margin-right: 10px; /* Adjust spacing between input and button */
                    }

                    .search-button {
                        background-color: #ddd;
                        border: none;
                        padding: 8px;
                        border-radius: 4px;
                        cursor: pointer;
                    }

                    .search-button:hover {
                        background-color: #ccc;
                    }

                    .footer {
                        background-color: #0c6291;
                        color: #ffffff;
                        padding: 20px 0;
                        width: 100%;
                    }

                    .footer-col {
                        padding: 0 15px;
                    }

                    .footer-col h4 {
                        font-size: 18px;
                        color: #ffffff;
                        text-transform: capitalize;
                        margin-bottom: 35px;
                        font-weight: 500;
                        position: relative;
                    }

                    .footer-col h4::before {
                        content: '';
                        position: absolute;
                        left: 0;
                        bottom: -10px;
                        background-color: #a63446;
                        height: 2px;
                        box-sizing: border-box;
                        width: 50px;
                    }

                    .footer-col ul li:not(:last-child) {
                        margin-bottom: 10px;
                    }

                    .footer-col ul li a {
                        font-size: 16px;
                        text-transform: capitalize;
                        color: #ffffff;
                        text-decoration: none;
                        font-weight: 300;
                        color: #bbbbbb;
                        display: block;
                        transition: all 0.3s ease;
                    }

                    .footer-col ul li a:hover {
                        color: #ffffff;
                        padding-left: 8px;
                    }

                    .footer-col .social-links a {
                        display: inline-block;
                        height: 40px;
                        width: 40px;
                        background-color: rgba(255, 255, 255, 0.2);
                        margin: 0 10px 10px 0;
                        text-align: center;
                        line-height: 40px;
                        border-radius: 50%;
                        color: #ffffff;
                        transition: all 0.5s ease;
                    }

                    .footer-col .social-links a:hover {
                        color: #24262b;
                        background-color: #ffffff;
                    }


                </style>
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
                                        <a href="other_pages/LoginPage/logout.php">Log out</a>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="nav-item">
                                    <a class="nav-link" href="other_pages/LoginPage/login_page.php">
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

                <div class="bg-gradient-light py-4">
                    <div class="container mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="shadow">
                                <img src="../AdminPage/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3><?= $product['name']; ?>
                                <span class="float text-danger fs-6 font-weight-lighter"><?php if($product['trending']){ echo "#Trending";} ?></span>
                            </h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Sale Price: £<?= $product['discounted_price']; ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h5>Original Price: <s class="text-danger"> £<?= $product['original_price']; ?> </s></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary px-4"><i class="fa fa-shopping-cart me-2"></i> Add to Basket</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-dark-blue px-4"><i class="fa fa-heart me-2"></i>Add to Wish List</button>
                                </div>
                            <hr>


                            <h6>Product Description:</h6>
                            <p><?= $product['description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    else
    {
        echo "<h3>Product Not Found</h3>";
    }
?>



    <?php
    }

    else
    {
    echo "<h3>Something Went Wrong</h3>";
    }
    ?>
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
            <script src="../AdminPage/https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="../AdminPage/assets/js/custom.js"></script>
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
