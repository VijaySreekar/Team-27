<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="custom-styles.css">
    <link rel="stylesheet" href="../NavBar/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<?php include("../NavBar/nav.php"); ?>

<div class="contact-form">
    <form action="process_contact_form.php" method="post">
        <h2>Contact Us</h2>
        <label for="name">Your Name:</label>
        <input type="text" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" name="email" required>

        <label for="message">Message:</label>
        <textarea name="message" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>

    <!-- Button to trigger the pop-up -->
    <button id="reviewButton" name="reviewButton" onclick="showReviewPopup()">Review Our Website</button>

    <!-- Hidden pop-up modal -->
    <div id="reviewModal" class="modal">
    <div class="modal-content">
     <span class="close" onclick="hideReviewPopup()">&times;</span>
     <h2>Review Our Website</h2>
     <form id="reviewForm" action="process_website_review.php" method="post">
          <label for="review">Have you experienced any issues with the website? Please let us know:</label>
          <textarea id="review" name="review" rows="4"></textarea>
          <input type="submit" value="Submit Review">
         </form>
     </div>
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

<script>
// JavaScript function to show the pop-up modal
function showReviewPopup() {
    document.getElementById("reviewModal").style.display = "block";
}

// JavaScript function to hide the pop-up modal
function hideReviewPopup() {
    document.getElementById("reviewModal").style.display = "none";
}
</script>
</body>

</html>
