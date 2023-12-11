<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Treakers Home Page</title>
    <link rel="stylesheet" href="HomePage.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="other_pages/NavBar/nav.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<!--Navigation Bar-->
<nav class="navbar">
    <div class="navbar-left">
        <div class="logo">
            <img src="Images/Treakers%20Logo.png" alt="Company Logo">
        </div>
    </div>
    <div class="navbar-center">
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="other_pages/ProductPage/products-page.php">Products</a></li>
            <li><a href="other_pages/AboutUsPage/aboutus.php">About</a></li>
            <li><a href="other_pages/ContactUsPage/contactus.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="navbar-right">
        <div class="buttons">
            <?php
            // Check if the user is logged in and has a valid session
            if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
                // Display the user-signed buttons with the same style as basket and search buttons
                echo '<button class="navbar-button"><i class="fas fa-user"></i> ' . $_SESSION['name'] . '</button>';
            } else {
                // Display the "Login/Signup" button with a class
                echo '<button class="navbar-button"><i class="fas fa-user"></i> Login/Signup</button>';
            }
            ?>
            <a href="other_pages/BasketPage/basket.php">
                <button class="navbar-button">
                    <i class="fas fa-shopping-basket"></i>
                </button>
            </a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button class="search-button"><i class="fas fa-search"></i></button>
        </div>
    </div>
</nav>
<!--Text on 1st picture-->

<section>
  <div class="bg" style="background-image: url('Images/Sneaker Wallpaper.jpeg')"></div>
  <h1>Treakers</h1>
  <p>Welcomes you to the family</p>
</section>

<!--Trending products section start-->

<body>
<section class="trending-section">
  <h1>Trending Products</h1>
</section>
<section>

  <div class="swiper">
    <div class="swiper-wrapper">

      <div class="swiper-slide swiper-slide-1">
        <div>
          <h2>Air Jordan 5</h2>
          <a>Buy Now</a>
        </div>
      </div>

      <div class="swiper-slide swiper-slide-2">
        <div>
          <h2>Air Jordan 6</h2>
          <a>Buy Now</a>
        </div>
      </div>

      <div class="swiper-slide swiper-slide-3">
        <div>
          <h2>Air Jordan 4</h2>
          <a>Buy Now</a>
        </div>
      </div>

      <div class="swiper-slide swiper-slide-4">
        <div>
          <h2>White Air Force 1</h2>
          <a>Buy Now</a>
        </div>
      </div>

      <div class="swiper-slide swiper-slide-5">
        <div>
          <h2>Air Jordan 1</h2>
          <a>Buy Now</a>
        </div>
      </div>

    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<!-- Add other swiper-slide elements as needed (DON'T FORGET TO ADD CSS TO ANY SLIDES ADDED HERE)-->

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>

<!--Trending items section end-->

<!--Text on 3rd picture-->
<section>
  <div class="bg" style="background-image: url('Images/Air Jordan 11.jpg.avif')"></div>
  <h1>Join us today</h1>
</section>

<script
  src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"
  src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"
  integrity="sha512-f8mwTB+Bs8a5c46DEm7HQLcJuHMBaH/UFlcgyetMqqkvTcYg4g5VXsYR71b3qC82lZytjNYvBj2pf0VekA9/FQ=="
  integrity="sha512-A64Nik4Ql7/W/PJk2RNOmVyC/Chobn5TY08CiKEX50Sdw+33WTOpPJ/63bfWPl0hxiRv1trPs5prKO8CpA7VNQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>


<script src="JS/HomePage.js"></script>

<!--Footer Section-->

<footer class="footer">
    <div class="fcontainer">
        <div class="row">
            <div class="footer-col">
                <h4>Treakers</h4>
                <ul>
                    <li><a href="../AboutUsPage/aboutus.php">about us</a></li>
                    <li><a href="../ProductPage/products-page.php">our products</a></li>
                    <li><a href="#">privacy policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="../ContactUsPage/contactus.php">Contact Us</a></li>
                    <li><a href="#">returns</a></li>
                    <li><a href="../BasketPage/basket.php">Basket</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>online shop</h4>
                <ul>
                    <li><a href="../../index.php">Sneakers</a></li>
                    <li><a href="../../index.php">Trainers</a></li>
                </ul>
            </div>
            <div class="footer-col">
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
</body>
</html>