<?php
session_start();
include 'Assets/Database/connectdb.php';
include 'Assets/Functions/myfunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchQuery'])) {
    $searchQuery = $mysqli->real_escape_string($_POST['searchQuery']);

    // Prepare statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT product_id, name, slug, image, discounted_price FROM product WHERE name LIKE CONCAT('%', ?, '%') AND status = 1 LIMIT 10");
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Return results as JSON and exit script to prevent further HTML rendering
    echo json_encode($products);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Treakers | Home Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700">
    <link id="pagestyle" href="Assets/CSS/material-dashboard.min.css" rel="stylesheet">
    <link href="Assets/CSS/nucleo-icons.css" rel="stylesheet">
    <link href="Assets/CSS/nucleo-svg.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Assets/CSS/HomePage.css">
    <link rel="stylesheet" href="Assets/CSS/nav.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <nav class="navbar bg-gradient-light ">
            <div class="navbar-left">
                <div class="logo">
                    <img src="Assets/Images/Treakers%20Logo.png" alt="Company Logo" class="logo-img" width="70px">
                </div>
                <div class="navbar-center ml-5">
                    <ul class="nav-links">
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="other_pages/ProductPage/category_page.php">Products</a></li>
                        <li><a href="other_pages/AboutUsPage/aboutus.php">About</a></li>
                        <li><a href="other_pages/ContactUsPage/contactus.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="navbar-right ml-3">
                <div class="login_buttons">
                    <?php
                    if(isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                        ?>
                        <div class="dropdown bg-gradient-secondary rounded">
                            <button class="logged-button btn bg-gradient-primary rounded fs-5 mr-3">
                                <a href="#" class="nav-link text-white">
                                    <span class="text-white"><i class="bi bi-person-check fs-5"></i> <?php echo $_SESSION['username']; ?></span>
                                </a>
                            </button>
                            <div class="dropdown-content">
                                <a href="other_pages/ProfilePage/profile.php">Your Profile</a>
                                <a href="other_pages/LoginPage/logout.php">Log out</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <button class="btn logged-button bg-gradient-primary rounded fs-5 mr-3 mt-3">
                            <a class="nav-link text-white" href="other_pages/LoginPage/login_page.php">
                                <i class="bi bi-person fs-5 mr-1"></i>Login/Signup
                            </a>
                        </button>
                        <?php
                    }
                    ?>
                </div>
                <div class="basket-icon">
                    <button class="btn basket-button bg-gradient-primary rounded fs-5 mr-3 mt-3">
                        <a href="other_pages/BasketPage/cart.php"><i class="bi bi-cart4 text-white"></i></a>
                    </button>
                </div>
                <div class="search-bar">
                    <input type="text" class="form-control search-input" placeholder="Search">
                    <button class="btn search-button bg-gradient-primary"><i class="bi bi-search"></i></button>
                    <div class="search-suggestions"></div> <!-- Container for search suggestions -->
                </div>

            </div>
        </nav>

    <section>
      <div class="bg" style="background-image: url('Assets/Images/mainwallpaper.jpg')"></div>
      <h1 class="fs-1 bg-gradient-faded-dark-blue text-white rounded mr-0 p-2">Treakers</h1>
      <h1 class="bg-gradient-faded-primary text-white p-2 rounded">Embrace your UrbanSole!</h1>
    </section>

    <section class="trending-section bg-gradient-faded-white">
        <h1 class="fs-2 text-black rounded text-center">Trending Products</h1>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php
                $trendingProducts = getAllTrending();
                echo mysqli_num_rows($trendingProducts);
                foreach ($trendingProducts as $product): ?>
                    <div class="swiper-slide" style="background: url('Assets/Images/Product_Images/<?php echo $product['image']; ?>') no-repeat 50% 50% / cover;">
                        <div>
                            <h2 class="text-white bg-gradient-faded-dark rounded p-2"><?php echo $product['name']; ?></h2>
                            <a href="other_pages/ProductPage/view_product.php?product=<?php echo $product['name']; ?>">Buy Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>


    <section>
        <div class="bg" style="background-image: url('Assets/Images/shoe slant.jpg')"></div>
        <h1 class="bg-gradient-faded-primary text-white p-2 rounded">Join us today</h1>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-col">
                    <h4>Treakers</h4>
                    <ul>
                        <li><a href="other_pages/AboutUsPage/aboutus.php">about us</a></li>
                        <li><a href="other_pages/ProductPage/products-page.php">our products</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="other_pages/ContactUsPage/contactus.php">Contact Us</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="other_pages/BasketPage/cart.php">Basket</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-col">
                    <h4>online shop</h4>
                    <ul>
                        <li><a href="#">Sneakers</a></li>
                        <li><a href="#">Trainers</a></li>
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

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="Assets/JS/HomePage.js"></script>
    <script src="Assets/JS/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                // Function to perform search
                function performSearch() {
                    var searchQuery = $('.search-input').val();
                    if (searchQuery.length > 2) {
                        $.ajax({
                            url: 'index.php', // Or the URL where your PHP search handling code is
                            type: 'POST',
                            dataType: 'json',
                            data: {searchQuery: searchQuery},
                            success: function(products) {
                                var suggestions = products.map(product =>
                                    `<div class='suggestion-item' data-slug='${product.slug}'>
            <img src='Assets/Images/Product_Images/${product.image}' class='suggestion-image'>
            <div class='suggestion-details'>
                <span class='suggestion-name'>${product.name}</span>
                <span class='suggestion-price'>£: ${product.discounted_price}</span>
            </div>
        </div>`
                                ).join('');
                                $('.search-suggestions').html(suggestions).show();
                            },
                        });
                    } else {
                        $('.search-suggestions').hide();
                    }
                }

                // Event listener for search input
                $('.search-input').on('input', function() {
                    performSearch();
                });

                // Event listener for search button
                $('.search-button').on('click', function(e) {
                    e.preventDefault(); // Prevent the form from submitting through the browser
                    performSearch();
                });

                // Event listener for clicking on a suggestion
                $(document).on('click', '.suggestion-item', function() {
                    var slug = $(this).data('slug');
                    window.location.href = `other_pages/ProductPage/view_product.php?product=${slug}`;
                });
            });
        </script>




</body>
</html>