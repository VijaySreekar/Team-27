<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';

$categories = getCategories(); // Assume implementation elsewhere
$categorySlug = $_GET['category'] ?? 'all';
$sortOrder = $_GET['sort_order'] ?? 'ASC';
$products = getProductsWithCategory($categorySlug, $sortOrder);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Products</title>

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
    <style>
        .category-links {
            overflow-x: auto;
            white-space: nowrap;
        }

        .category-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            color: #333;
            text-decoration: none;
            border-radius: 0.25rem;
            transition: background-color 0.3s;
        }

        .category-link.active {
            background-color: #007bff;
            color: #fff;
        }

        #price-sort {
            width: 200px; /* Adjust width as needed */
        }
    </style>
</head>
<body>
<main class="main-content">
    <?php include("../../Includes/nav.php"); ?>

    <nav class="breadcrumbs">
        <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
        <a href="#" class="breadcrumbs__item is-active"> <i class="bi bi-diagram-3"></i>  All Products</a>
    </nav>

    <div class="container py-5">
        <div class="card">
            <div class="card card-header">
                <h1 class="mb-4">All Products</h1>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="category-links">
                        <a href="?category=all" class="category-link <?= empty($_GET['category']) ? 'active' : '' ?>" data-category="all">All Categories</a>
                        <?php foreach($categories as $cat): ?>
                            <a href="?category=<?= htmlspecialchars($cat['slug'], ENT_QUOTES) ?>" class="category-link <?= ($_GET['category'] ?? 'all') === $cat['slug'] ? 'active' : '' ?>" data-category="<?= htmlspecialchars($cat['slug'], ENT_QUOTES) ?>"><?= htmlspecialchars($cat['name'], ENT_QUOTES) ?></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group mb-0">
                        <select class="form-control" id="price-sort" onchange="updateSortOrder(this.value);">
                            <option value="low_to_high">Price: Low to High</option>
                            <option value="high_to_low">Price: High to Low</option>
                        </select>
                    </div>
                </div>
            <div class="card-body">
                <div class="row">
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="../../Assets/Images/Product_Images/<?= htmlspecialchars($product["image"], ENT_QUOTES) ?>" class="card-img-top" alt="<?= htmlspecialchars($product["name"], ENT_QUOTES) ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($product["name"], ENT_QUOTES) ?></h5>
                                        <?php if ($product["discounted_price"] < $product["original_price"]): ?>
                                            <p class="card-text">Sale: £<?= htmlspecialchars($product["discounted_price"], ENT_QUOTES) ?><span class="original-price"> £<?= htmlspecialchars($product["original_price"], ENT_QUOTES) ?></span></p>
                                        <?php else: ?>
                                            <p class="card-text">Price: £<?= htmlspecialchars($product["discounted_price"], ENT_QUOTES) ?></p>
                                        <?php endif; ?>
                                        <button onclick="addToCart(<?= $product["product_id"] ?>, 1)" class="btn btn-primary">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col">
                            <p>No products found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php include("../../Includes/footer.php"); ?>


</main>
<script src="../../Assets/JS/jquery-3.5.1.min.js"></script>
<script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
<script>
    function updateSortOrder(sortOrder) {
        // Retrieve the current category or default to 'all'
        const category = new URLSearchParams(window.location.search).get('category') || 'all';
        // Update the URL with the new sort order, maintaining the current category selection
        window.location.href = `products_page.php?category=${category}&sort_order=${sortOrder}`;
    }
</script>
</body>
</html>
