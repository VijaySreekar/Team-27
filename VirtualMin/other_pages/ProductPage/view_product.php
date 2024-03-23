<?php

session_start();
include '../AdminPage/AllFunctions/myfunctions.php';
include '../../connectdb.php';


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
                    <a href="../ProductPage/category_page.php" class="breadcrumbs__item">Categories</a>
                    <a href="../ProductPage/products_page.php?category=<?= $category_name ?>" class="breadcrumbs__item">Products</a>
                    <a href="../ProductPage/view_product.php" class="breadcrumbs__item is-active"><?= $product['name'] ?></a>
                </nav>

                <div class="container mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="shadow-danger">
                                <img src="../AdminPage/<?= $product['image']; ?>" alt="Product Image" class="w-100">
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
                        	//echo "<p>".$pid."</p>";
    						
                        	$sql = "SELECT * FROM user_review WHERE
                            		product_id=$pid";
    						
    						$query = mysqli_query($mysqli, $sql);
    						$count = mysqli_num_rows($query);
    						
    						if($count == 0){
                            	echo "<p> No reviews yet! </p>";
                            } else {
                            	echo "<h3>".$count." reviews:</h3>";
                            	while($row = mysqli_fetch_assoc($query)){
                            		echo "<div class=\"review-card\">";
                           			echo "<p>".$row['user_id']."</p>";
                            		echo "<p>".$row['rating']."</p>";
                            		echo "<p>".$row['comment']."</p>";
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
</html>
