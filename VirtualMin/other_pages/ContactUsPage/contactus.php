<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Category Page</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Truncleta:wght@400&display=swap">
    <link rel="stylesheet" href="../NavBar_Footer/nav.css">

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
    <style>

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.7); /* Adjust opacity if needed */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px); /* Adjust blur amount if needed */
            margin: 15% auto;
            max-width: 80%;
        }

        .modal-content h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            color: #a63446; /* Adjust color if needed */
        }

        .modal-content h2::after {
            content: "";
            display: block;
            width: 30%;
            height: 2px;
            background-color: #3498db; /* Adjust color if needed */
            position: absolute;
            bottom: -5px;
            left: 0;
        }

        .modal-content label {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333; /* Adjust color if needed */
        }

        .modal-content textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .modal-content input[type="submit"] {
            background-color: #a63446; /* Adjust color if needed */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-content input[type="submit"]:hover {
            background-color: #3498db; /* Adjust color if needed */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <?php include("../NavBar_Footer/new_nav.php"); ?>

        <nav class="breadcrumbs">
            <a href="../../index.php" class="breadcrumbs__item">Home</a>
            <a href="../ContactUsPage/contactus.php" class="breadcrumbs__item is-active">ContactUs</a>
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

        <?php include("../NavBar_Footer/footer.html"); ?>
    </main>
</body>
</html>
