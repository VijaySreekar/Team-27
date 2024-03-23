<?php

session_start();
include '../AdminPage/AllFunctions/myfunctions.php';
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
    <link rel="stylesheet" href="../NavBar_Footer/nav.css">

    <!-- Nucleo Icons -->
    <link href="../AdminPage/assets/nucleo-icons.css" rel="stylesheet" />
    <link href="../AdminPage/assets/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../AdminPage/assets/material-dashboard.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="../NavBar_Footer/new_nav.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <?php include '../NavBar_Footer/new_nav.php'; ?>

        <nav class="breadcrumbs">
            <a href="../../index.php" class="breadcrumbs__item">Home</a>
            <a href="../ProductPage/category_page.php" class="breadcrumbs__item is-active">Categories</a>
        </nav>


        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Our Categories</h1>
                        <hr>
                        <div class="row">

                            <?php
                                $category = getAllActive('category');

                                if(mysqli_num_rows($category) > 0)
                                {
                                    foreach($category as $item)
                                    {
                                        ?>
                                            <div class="col-md-3 mb-3">
                                                <a href="products_page.php?category=<?= $item['slug']; ?>">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <img src="../AdminPage/<?= $item['image']; ?>" alt="Category Image" class="w-100">
                                                            <h4 class="text-center"><?= $item['name']; ?></h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<h3>No Categories Found</h3>";
                                }
                            ?>
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
    <script src="../AdminPage/https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../AdminPage/assets/js/custom.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        <?php
            if(isset($_SESSION['message']))
            {
                ?>
                alertify.set('notifier','position', 'top-right');
                alertify.success('<?= $_SESSION['message']; ?>');
                <?php
                unset($_SESSION['message']);
            }
        ?>
    </script>

</body>
</html>
