<?php
session_start();
include "../../Assets/Database/connectdb.php";

$order_id = $_GET['orderId'] ?? null;

if (!$order_id) {
    echo "Order ID is required.";
    exit;
}

// Fetch products in the order
$sql = "SELECT p.product_id, p.name, p.description, p.image FROM order_items oi JOIN product p ON oi.product_id = p.product_id WHERE oi.order_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

    // Insert review into the database
    $sql = "INSERT INTO user_review (user_id, product_id, order_id, rating, comment) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iiiis", $user_id, $product_id, $order_id, $rating, $comment);
    $stmt->execute();

    // Redirect or display a success message
    echo "Review submitted successfully!";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Leave a Review!</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SweetAlert2 CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../AdminPage/assets/js/custom.js"></script>

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

<body class="g-sidenav-show  bg-gray-200">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <?php include("../../Includes/nav.php"); ?>

    <nav class="breadcrumbs">
        <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
        <a href="../ProductPage/category_page.php" class="breadcrumbs__item"><i class="bi bi-person"></i> Profile</a>
        <a href="#" class="breadcrumbs__item"><i class="bi bag-check"></i> My Orders</a>
        <a href="#" class="breadcrumbs__item is-active"><i class="bi bi-star"></i> Leave a Review</a>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="card card-header">
                <h2>Leave a Review</h2>
            </div>
            <div class="card card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="product">Select Product:</label>
                        <select name="product_id" id="product" class="form-control" required>
                            <option value="">--Select a Product--</option>
                            <?php foreach ($products as $product): ?>
                                <option value="<?= htmlspecialchars($product['product_id']) ?>" data-name="<?= htmlspecialchars($product['name']) ?>" data-image="../../Assets/Images/Product_Images/<?= htmlspecialchars($product['image']) ?>" data-description="<?= htmlspecialchars($product['description']) ?>">
                                    <?= htmlspecialchars($product['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="product-info" class="d-none">
                        <div class="card shadow">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img id="product-image" class="card-img-top" src="" alt="Product Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 id="product-name" class="card-title"></h5>
                                        <p id="product-description" class="card-text"></p>
                                        <p id="product-price" class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="rating">Rating (1-5):</label>
                        <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment" rows="5" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
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

<script>
    $(document).ready(function() {
        $('#product').change(function() {
            var selectedProduct = $(this).find(':selected');
            var productName = selectedProduct.data('name');
            var productImage = selectedProduct.data('image');
            var productDescription = selectedProduct.data('description');

            $('#product-name').text(productName);
            $('#product-image').attr('src', productImage);
            $('#product-description').text(productDescription);
            $('#product-info').removeClass('d-none');
        });
    });
</script>

</body>
</html>







