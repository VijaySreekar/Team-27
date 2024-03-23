<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Category Page</title>

    <link rel="stylesheet" href="login.css">
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Truncleta:wght@400&display=swap">
    <link rel="stylesheet" href="../NavBar_Footer/new_nav.css">

    <!-- Nucleo Icons -->
    <link href="../AdminPage/assets/nucleo-icons.css" rel="stylesheet" />
    <link href="../AdminPage/assets/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../AdminPage/assets/material-dashboard.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="../NavBar_Footer/new_nav.css">
</head>

<body class="g-sidenav-show bg-gray-200">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include '../NavBar_Footer/new_nav.php'; ?>
    <div class="container mt-7 mb-9">
        <input type="checkbox" id="change" style="display: none;">
        <div class="cover">
            <div class="login">
                <img class="backImg" src="../../Images/Shoe%201%20(Login).png" alt="" style="object-fit: cover; width: 100%; height: 100%;"></div>
            <div class="register" style="transform: rotateY(180deg); position: absolute; width: 100%; height: 100%;">
                <img class="backImg" src="../../Images/Shoe%202%20(Registration).png" alt="" style="object-fit: cover; width: 100%; height: 100%;">
            </div>
        </div>
        <div class="loginregister_form pt-4" style="background: rgba(251,254,249,0);">
            <div class="content" style="display: flex; justify-content: space-between;">
                <div class="passwordreset-form">
                    <div class="title" style="font-size: 24px; font-weight: 500; color: #333;">Password Recovery</div>
                    <form id="passwordreset-form" action="handle_reset_password.php" method="post">
                        <div class="input-boxes" style="margin-top: 30px;">
                            <div class="input-box" style="display: flex; align-items: center; position: relative;">
                                <i class="fas fa-user" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                <input type="text" placeholder="Enter your email" name="email" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                <input type="password" name="new_password" placeholder="New password" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                <input type="password" name="confirm_password" placeholder="Confirm password" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                            </div>
                            <div class="button input-box" style="margin-top: 40px;">
                                <input type="submit" value="Reset Password" style="color: #fff; background: #0c6291; border-radius: 6px; cursor: pointer;">
                            </div>
                        </div>
                    </form>
                    <div id="error-message" style="color:red;"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../NavBar_Footer/footer.html'; ?>
</main>
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

