<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Contact Us</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Truncleta:wght@400&display=swap">
    <link rel="stylesheet" href="../../Assets/CSS/nav.css">

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
    <link rel="stylesheet" href="../../Assets/CSS/contactus.css">
</head>

<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <?php include("../../Includes/nav.php"); ?>

        <nav class="breadcrumbs">
            <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
            <a href="../ContactUsPage/contactus.php" class="breadcrumbs__item is-active"><i class="bi bi-envelope"></i> Contact Us</a>
        </nav>

        <div class="py-5">
            <div class="container">
                <div class="card">
                    <div class="card-body shadow">
                        <form action="process_contact_form.php" method="post">
                            <h2>Contact Us</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-bold">Your Name:</label>
                                    <input type="text" name="name" required class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-bold">Your Email:</label>
                                    <input type="email" name="email" required class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="message" class="form-label fw-bold">Message:</label>
                                    <textarea name="message" rows="4" required class="form-control"></textarea>
                                </div>
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>

                        <!-- Button to trigger the pop-up for reviews, adapted to new styling -->
                        <button id="reviewButton" name="reviewButton" class="btn btn-info mt-3" onclick="showReviewPopup()">Review the Treakers website</button>

                        <!-- Hidden pop-up modal, maintained as it doesn't specifically conflict with the reference's styling guidelines -->
                        <div id="reviewModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideReviewPopup()">&times;</span>
                                <h2>Review the Treakers website</h2>
                                <form id="reviewForm" action="process_website_review.php" method="post">
                                    <label for="review">Have you experienced any issues with the website? Please let us know:</label>
                                    <textarea id="review" name="review" rows="4" class="form-control"></textarea>
                                    <input type="submit" value="Submit Review" class="btn btn-primary mt-3">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("../../Includes/footer.php"); ?>
    </main>
    <script src="../../Assets/JS/jquery-3.7.1.js"></script>
    <script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
    <script src="../../Assets/JS/smooth-scrollbar.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/login.js"></script>
</body>
</html>
