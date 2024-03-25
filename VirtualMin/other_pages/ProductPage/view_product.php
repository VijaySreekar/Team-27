<?php

session_start();
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';


function getCategoryName(mixed $category_id)
{
    global $mysqli;
    $sql = "SELECT name FROM category WHERE category_id = $category_id";
    $result = mysqli_query($mysqli, $sql);
    $category = mysqli_fetch_assoc($result);
    return $category['name'];
}

if(isset($_GET['product']))
{

    $product_slug = $_GET['product'];
    $product_data = getSlugActive('product', $product_slug);
    $product = mysqli_fetch_assoc($product_data);

    if($product)
    {
        $product_id = $product['product_id'];
        $category_id = $product['category_id'];
        $category_name = getCategoryName($category_id);
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <title>
                    <?= $product['name']; ?>
                </title>

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
                <script src="../AdminPage/assets/js/custom.js"></script>

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
                    <a href="../ProductPage/products_page.php?category=<?= $category_name ?>" class="breadcrumbs__item"><i class="bi bi-box"></i> <?= $category_name?></a>
                    <a href="../ProductPage/view_product.php" class="breadcrumbs__item is-active"><?= $product['name'] ?></a>
                </nav>

                <div class="container mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="shadow-danger">
                                <img src="../../Assets/Images/Product_Images/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-6 shadow-dark">
                            <h2 class="fw-bold"><?= $product['name']; ?></h2>
                            <?php if($product['trending']): ?>
                                <span class="text-danger fs-6 font-weight-lighter">#Trending</span>
                            <?php endif; ?>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h4>Sale Price: £<?= $product['discounted_price']; ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h5>Original Price: <s class="text-danger">£<?= $product['original_price']; ?></s></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <h7 class="mr-3 mt-1">Quantity: </h7>
                                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="10">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-lg btn-block addToCartButton" value="<?= $product['product_id']; ?>"><i class="fa fa-shopping-cart me-2"></i> Add to Basket</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-dark btn-lg btn-block"><i class="fa fa-heart me-2"></i>Add to Wish List</button>
                                </div>
                            </div>
                            <hr>
                            <h4 class="fw-bold mb-3">Product Description:</h4>
                            <p><?= $product['description']; ?></p>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="col-md-12 shadow-dark">
                        <?php
                        $pid = $product['product_id'];
                        // Adjust the SQL query to include a join with the orders table if you want to display reviews specifically for this user's orders.
                        // Note: This assumes you want to show all reviews for the product, not filtered by the current user's orders. Adjust accordingly if needed.
                        $sql = "SELECT ur.*, u.username FROM user_review ur 
            JOIN user u ON ur.user_id = u.user_id 
            WHERE ur.product_id = ?";

                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("i", $pid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $count = $result->num_rows;

                        if ($count == 0) {
                            echo "<p> No reviews yet! </p>";
                        } else {
                            echo "<h3>" . $count . " reviews:</h3>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class=\"review-card\">";
                                echo "<p>" . htmlspecialchars($row['username']) . "</p>";
                                echo "<p>Rating: " . htmlspecialchars($row['rating']) . "</p>";
                                echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
                                echo "</div>";
                            }
                        }
                        ?>
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
