<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login/Register</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../NavBar/nav.css">


</head>

<body>
<?php
include '../NavBar/nav.php';
?>
<div class="container">
    <input type="checkbox" id="change">
    <div class="cover">
        <div class="login">
            <img class="backImg" src="../../Images/Shoe%201%20(Login).png" alt="">
            <div class="text">
                <span class="slogan-1">Start your Adventure <br> Here</span>
                <span class="slogan-2">Login and Discover!</span>
            </div>
        </div>
        <div class="register">
            <img class="backImg" src="../../Images/Shoe%202%20(Registration).png" alt="">
        </div>
    </div>
    <div class="loginregister_form">
        <div class="content">
            <div class="login_form">
                <div class="title">Login</div>
                <form id="login-form" action="VerifyUser.php" method="post">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" placeholder="Enter your email" name="login_email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="login_password" placeholder="Enter your password" required>
                        </div>
                        <a href="forgot_password.php" class="forgot-password-link">Forgot Password?</a>
                        <div class="button input-box">
                            <input type="submit" value="Login">
                        </div>
                        <div class="text sign-up-text">Don't have an account? <label for="change">Signup now</label></div>
                    </div>
                </form>
                <div id="error-message" style="color:red;"></div>
            </div>
            <div class="signup_form">
                <div class="title">Signup</div>
                <form id="signup-form" action="RegisterUser.php" method="post">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" name="reg_name" placeholder="Enter your name" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" name="reg_email"  placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="reg_password"  placeholder="Enter your password" required>
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Register">
                        </div>
                        <div class="text sign-up-text">Already have an account? <label for="change">Login now</label></div>
                    </div>
                </form>
                <div id="signup-error-message" style="color:red;"></div>
            </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#login-form").on("submit", function(event){
            event.preventDefault();
            console.log("Form submitted");

            $.ajax({
                url: "VerifyUser.php",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response){
                    if(response.success){
                        window.location.href = 'dashboard.php';
                    } else {
                        $("#error-message").text(response.message);
                    }
                },
                error: function(xhr, status, error){
                    console.error("AJAX error: " + status + ": " + error); // Log AJAX errors
                }
            });
        });
    });

    $(document).ready(function(){
        $("#signup-form").on("submit", function(event){
            event.preventDefault();
            console.log("Signup form submitted");

            $.ajax({
                url: "RegisterUser.php",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response){
                    if(response.success){
                        alert("Registration successful!"); // Or handle as needed
                    } else {
                        $("#signup-error-message").text(response.message);
                    }
                },
                error: function(xhr, status, error){
                    console.error("AJAX error: " + status + ": " + error);
                    $("#signup-error-message").text("An error occurred during registration.");
                }
            });
        });
    });
</script>


</body>
</html>
