<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>About Us</title>

    <link rel="icon" type="image/png" sizes="76x76" href="../../Assets/Images/Treakersfavicon.png">

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
</head>
<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <?php include("../../Includes/nav.php"); ?>

        <nav class="breadcrumbs">
            <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
            <a href="../AboutUsPage/aboutus.php" class="breadcrumbs__item is-active"><i class="bi bi-info-circle"></i> About Us</a>
        </nav>

        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-lg-5 d-flex justify-content-center align-items-center">
                    <img class="main-img img-fluid rounded" src="../../Assets/Images/SneakerSketch.png" alt="Sneaker Sketch" style="max-height: 75vh;">
                </div>
                <div class="col-lg-7 d-flex align-items-center">
                    <div class="content px-3">
                        <div class="about-us mb-3">
                            <h2 class="heading">About Us</h2>
                            <p class="sub-heading">Welcome to Treakers! We are an innovative Sneaker company...</p>
                            <p>We believe that sneakers are more than just shoes. Our mission is to provide high-quality, stylish sneakers that not only look great but also offer comfort and durability. We are passionate about sneaker culture and strive to create products that reflect the latest trends and technologies.</p>
                        </div>
                        <div class="values">
                            <!-- Card Content -->
                            <div class="card mb-2">
                                <div class="card-body d-flex" style="padding: 0.75rem;">
                                    <i class="fas fa-check-circle text-dark-blue" style="font-size: 1.2rem;"></i>
                                    <div class="card-text ml-3">
                                        <h5 class="card-heading">Quality</h5>
                                        <p class="card-sub-heading" style="font-size: 0.9rem;">Our commitment to quality and craftsmanship sets us apart. We use premium materials to ensure the longevity of our sneakers, making them a valuable addition to your wardrobe.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body d-flex" style="padding: 0.75rem;">
                                    <i class="fas fa-leaf text-dark-blue" style="font-size: 1.2rem;"></i>
                                    <div class="card-text ml-3">
                                        <h5 class="card-heading">Sustainability</h5>
                                        <p class="card-sub-heading" style="font-size: 0.9rem;">We believe in sustainability. Our production processes are eco-friendly, and we continuously strive to minimize our environmental footprint.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body d-flex" style="padding: 0.75rem;">
                                    <i class="fas fa-user-check text-dark-blue" style="font-size: 1.2rem;"></i>
                                    <div class="card-text ml-3">
                                        <h5 class="card-heading">Customer Satisfaction</h5>
                                        <p class="card-sub-heading" style="font-size: 0.9rem;">Customer satisfaction is our top priority. We provide excellent customer service and support to ensure that you have the best shopping experience with us.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body d-flex" style="padding: 0.75rem;">
                                    <i class="fas fa-cogs text-dark-blue" style="font-size: 1.2rem;"></i>
                                    <div class="card-text ml-3">
                                        <h5 class="card-heading">Innovation</h5>
                                        <p class="card-sub-heading" style="font-size: 0.9rem;">Innovation drives us. We constantly innovate and explore new designs and technologies to stay at the forefront of the sneaker industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="../ContactUsPage/contactus.php" class="btn btn-primary btn-lg mt-2" style="padding: 10px 20px; font-size: 1.1rem;">Contact Us</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../Assets/JS/custom.js"></script>
    <script src="../../Assets/JS/searchbar.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/65ff54951ec1082f04da7f5c/1hpmm4q27';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
</body>
</html>
