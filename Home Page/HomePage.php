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
  </head>
  <body>
  <!--Navigation Bar-->
  <?php include("Nav Bar\\nav.php"); ?>
<!--Text on picture--> 
    <section>
      <div class="bg" style="background-image: url('Sneaker Wallpaper.jpeg')"></div>
      <h1>Treakers</h1>
      <p>Welcomes you to the family</p>
    </section>
<!--Trending items section-->
  <body>
    <section class="trending-section">
      <h1>Trending Items</h1>
          <!-- Add other swiper-slide elements as needed -->
    </section>
    <section>
      <div class="swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide swiper-slide--one">
            <div>
              <h2>Air Jordan 5</h2>
              <a>Buy Now</a>
            </div>
          </div>
          <div class="swiper-slide swiper-slide--two">
            <div>
              <h2>Air Jordan 6</h2>
              <a>Buy Now</a>
            </div>
          </div>
          <div class="swiper-slide swiper-slide--three">
            <div>
              <h2>Air Jordan 4</h2>
              <a>Buy Now</a>
            </div>
          </div>
          <div class="swiper-slide swiper-slide--four">
            <div>
              <h2>White Air Force 1</h2>
              <a>Buy Now</a>
            </div>
          </div>
          <div class="swiper-slide swiper-slide--five">
            <div>
              <h2>Air Jordan 1</h2>
              <a>Buy Now</a>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  </body>
<!--Trending items section-->
    <section>
      <div class="bg" style="background-image: url('Air Jordan 11.jpg.avif')"></div>
      <h1>Join us today</h1>
  </section>
  
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"
      integrity="sha512-f8mwTB+Bs8a5c46DEm7HQLcJuHMBaH/UFlcgyetMqqkvTcYg4g5VXsYR71b3qC82lZytjNYvBj2pf0VekA9/FQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"
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


