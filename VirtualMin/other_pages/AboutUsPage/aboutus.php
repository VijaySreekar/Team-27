<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <link rel="stylesheet" href="aboutus.css">
    <link rel="stylesheet" href="../NavBar/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php include("../NavBar/nav.php"); ?>

<div class="container">
    <div class="left">
        <img class="main-img" src="../../Images/SneakerSketch.png" alt="Sneaker Sketch">
    </div>
    <div class="right">
        <p class="heading">About Us</p>
        <p class="sub-heading">Welcome to Treakers! We are an innovative Sneaker company...</p>
        <p>We believe that sneakers are more than just shoes. Our mission is to provide high-quality, stylish sneakers that not only look great but also offer comfort and durability. We are passionate about sneaker culture and strive to create products that reflect the latest trends and technologies.</p>
        <div class="card">
            <i class="fas fa-check-circle"></i>
            <div class="card-text">
                <p class="card-heading">Quality</p>
                <p class="card-sub-heading">Our commitment to quality and craftsmanship sets us apart. We use premium materials to ensure the longevity of our sneakers, making them a valuable addition to your wardrobe.</p>
            </div>
        </div>
        <div class="card">
            <i class="fas fa-leaf"></i>
            <div class="card-text">
                <p class="card-heading">Sustainability</p>
                <p class="card-sub-heading">We believe in sustainability. Our production processes are eco-friendly, and we continuously strive to minimize our environmental footprint.</p>
            </div>
        </div>
        <div class="card">
            <i class="fas fa-user-check"></i>
            <div class="card-text">
                <p class="card-heading">Customer Satisfaction</p>
                <p class="card-sub-heading">Customer satisfaction is our top priority. We provide excellent customer service and support to ensure that you have the best shopping experience with us.</p>
            </div>
        </div>
        <div class="card">
            <i class="fas fa-cogs"></i>
            <div class="card-text">
                <p class="card-heading">Innovation</p>
                <p class="card-sub-heading">Innovation drives us. We constantly innovate and explore new designs and technologies to stay at the forefront of the sneaker industry.</p>
            </div>
        </div>
        <a href="../ContactUsPage/contactus.php">
            <button class="contact-btn">Contact Us</button>
        </a>
    </div>
</div>
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
