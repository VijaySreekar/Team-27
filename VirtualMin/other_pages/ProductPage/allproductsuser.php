<?php
session_start();
include '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';

// Assuming getCategories() fetches an array of categories from the database
$categories = getCategories(); // You'll need to implement this function

// Assuming getProductsWithCategory() fetches products based on category and sort order
$categorySlug = isset($_GET['category']) ? $_GET['category'] : 'all';
$sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';
$products = getProductsWithCategory($categorySlug, $sortOrder);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Bootstrap CSS (Keep existing version) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Navigation CSS -->
    <link rel="stylesheet" href="../../Assets/CSS/nav.css">
    <!-- Page specific CSS -->
    <link rel="stylesheet" href="productstyles.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .category-links {
            margin-bottom: 20px;
        }
        .category-link {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
            font-size: 16px;
        }
        .category-link:hover {
            text-decoration: underline;
        }
        #price-sort {
            margin-left: 10px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fff;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .product-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .product-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .product-info {
            margin-top: 10px;
        }
        .product-price {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .original-price {
            color: #999;
            text-decoration: line-through;
            margin-left: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<main class="main-content">
    <?php include("../../Includes/nav.php"); ?>

    <nav class="breadcrumbs">
        <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
        <a href="../ProductPage/products_page.php" class="breadcrumbs__item is-active"><i class="bi bi-box"></i> All Products</a>
    </nav>

    <section class="product-page container">
        <header class="page-header">
            <h1>Our Product Collection</h1>
            <div class="category-links">
                <!-- Dynamically generate category links -->
                <a href="?category=all" class="category-link" data-category="all">All Categories</a>
                <?php foreach($categories as $cat): ?>
                    <a href="?category=<?= htmlspecialchars($cat['slug'], ENT_QUOTES) ?>" class="category-link" data-category="<?= htmlspecialchars($cat['slug'], ENT_QUOTES) ?>"><?= htmlspecialchars($cat['name'], ENT_QUOTES) ?></a>
                <?php endforeach; ?>
                <select id="price-sort" onchange="updateSortOrder(this.value);">
                    <option value="low_to_high">Price: Low to High</option>
                    <option value="high_to_low">Price: High to Low</option>
                </select>
            </div>
        </header>

        <div class='product-grid'>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class='product-item' onclick='showProductDetail(<?= htmlspecialchars($product["product_id"], ENT_QUOTES) ?>)'>
                        <img src='../AdminPage/<?= htmlspecialchars($product["image_link"], ENT_QUOTES) ?>' alt='<?= htmlspecialchars($product["name"], ENT_QUOTES) ?>' class='w-100' />
                        <div class='product-info'>
                            <h4><?= htmlspecialchars($product["name"], ENT_QUOTES) ?></h4>
                            <?php if ($product["discounted_price"] < $product["original_price"]): ?>
                                <p class='product-price'>Sale: £<?= htmlspecialchars($product["discounted_price"], ENT_QUOTES) ?> <span class='original-price'>£<?= htmlspecialchars($product["original_price"], ENT_QUOTES) ?></span></p>
                            <?php else: ?>
                                <p class='product-price'>Price: £<?= htmlspecialchars($product["discounted_price"], ENT_QUOTES) ?></p>
                            <?php endif; ?>
                            <button onclick='addToCart(<?= $product["product_id"] ?>, 1)' class='btn btn-primary'>Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </section>

    <?php include("../../Includes/footer.php"); ?>
</main>
<script src="../../Assets/JS/jquery-3.5.1.min.js "></script>
<script src="../../Assets/JS/bootstrap.bundle.min.js "></script>
<script>
    function updateSortOrder(sortOrder) {
        const category = new URLSearchParams(window.location.search).get('category') || 'all';
        window.location.href = `products_page.php?category=${category}&sort_order=${sortOrder}`;
    }
</script>
</body>
</html>
