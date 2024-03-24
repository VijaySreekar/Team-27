<?php

session_start();
include '../../Assets/Functions/myfunctions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Categories</title>

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
            <a href="../ProductPage/category_page.php" class="breadcrumbs__item is-active"><i class="bi bi-list"></i> Categories</a>
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

        <?php include("../../Includes/footer.php"); ?>

    </main>
    <script src="../../Assets/JS/jquery-3.7.1.js"></script>
    <script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
    <script src="../../Assets/JS/smooth-scrollbar.min.js"></script>
    <script src="../AdminPage/https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../Assets/JS/custom.js"></script>
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
