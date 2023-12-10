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
  </head>
  <body>
  
    <!--Navigation Bar-->
  
    <body>
      <nav class="navbar navbar-fixed-top">
          <div class="navbar-left">
              <div class="logo">
                  <img src="Treakers Logo.png" alt="Company Logo">
              </div>
          </div>
          <div class="navbar-center">
              <ul class="nav-links">
                  <li><a href="../index.html">Home</a></li>
                  <li class="center"><a href="../products-page.php">Products</a></li>
                  <li class="upward"><a href="../aboutus.php">About</a></li>
                  <li class="forward"><a href="../contacatus.php">Contact Us</a></li>
              </ul>
          </div>
          <div class="navbar-right">
              <div class="buttons">
                  <?php
                  // Check if the user is logged in and has a valid session
                  if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
                      // Display the username with a class
                      echo '<span class="username"><i class="fas fa-user"></i> ' . $_SESSION['name'] . '</span>';
                  } else {
                      // Display the "Login/Signup" button with a class
                      echo '<button class="login-signup-btn"><i class="fas fa-user"></i> Login/Signup</button>';
                  }
                  ?>
                  <button class="basket">
                      <i class="fas fa-shopping-basket"></i>
                  </button>
              </div>
              <div class="search-bar">
                  <input type="text" placeholder="Search">
                  <button class="search-button"><i class="fas fa-search"></i></button>
              </div>
          </div>
      </nav>
  </body>

    <!--Text on 1st picture--> 
    
    <section>
      <div class="bg" style="background-image: url('Sneaker Wallpaper.jpeg')"></div>
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
              <!-- <a>Buy Now</a> (Remove Comment tags for later use) -->
            </div>
          </div>

          <div class="swiper-slide swiper-slide-2">
            <div>
              <h2>Air Jordan 6</h2>
              <!-- <a>Buy Now</a> (Remove Comment tags for later use) -->
            </div>
          </div>

          <div class="swiper-slide swiper-slide-3">
            <div>
              <h2>Air Jordan 4</h2>
              <!-- <a>Buy Now</a> (Remove Comment tags for later use) -->
            </div>
          </div>

          <div class="swiper-slide swiper-slide-4">
            <div>
              <h2>White Air Force 1</h2>
              <!-- <a>Buy Now</a> (Remove Comment tags for later use) -->              
            </div>
          </div>

          <div class="swiper-slide swiper-slide-5">
            <div>
              <h2>Air Jordan 1</h2>
              <!-- <a>Buy Now</a> (Remove Comment tags for later use) -->
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
      <div class="bg" style="background-image: url('Air Jordan 11.jpg.avif')"></div>
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


    <script src="HomePage.js"></script>

    <!--Footer Section-->
    
    <footer>
      <p2>&copy; 2023 Treakers. All rights reserved.</p2>
    </footer>
  </body>