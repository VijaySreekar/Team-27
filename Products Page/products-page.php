<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treakers</title>
    <link rel="icon" type="image/x-icon" href="">
    <link rel="stylesheet" type="text/css" href="productstyles.css">
    <link rel="stylesheet" href="../Nav%20Bar/nav.css">
    <style>
        /* Base styling for the product detail section */
        .product-detail {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .product-detail h3 {
            margin-top: 0;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        .product-detail img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin: 20px 0;
        }

        /* Styling for the price and add to cart button */
        .product-detail p {
            margin: 10px 0;
            color: #555;
            font-size: 18px;
        }

        .product-detail select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }

        .product-detail button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-detail button:hover {
            background-color: #0056b3;
        }

    </style>
    <!-- The script below basically works so that when a category link is clicked, it loops
    through all product categories and either shows or hides them based on whether their
    ID matches the selected category (and if all is selected, then all are shown)-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryLinks = document.querySelectorAll('.category-link');
            const productItems = document.querySelectorAll('.product-item');
            const productDetail = document.querySelector('.product-detail');

            categoryLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const selectedCategory = this.getAttribute('data-category');

                    productItems.forEach(item => {
                        if (selectedCategory === 'all' || item.classList.contains('category-' + selectedCategory)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Hide the product detail when a category link is clicked
                    productDetail.style.display = 'none';
                });
            });

            function fetchProductDetails(productId) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_product_details.php?product_id=' + productId, true);
                xhr.onload = function() {
                    if (this.status === 200) {
                        const productDetail = document.querySelector('.product-detail');
                        productDetail.innerHTML = this.responseText;
                    } else {
                        alert('Failed to fetch product details.');
                    }
                }
                xhr.send();
            }

            // Make showProductDetail globally accessible
            window.showProductDetail = function(productId) {
                const productDetail = document.querySelector('.product-detail');
                const productItems = document.querySelectorAll('.product-item');

                // Hide all product items
                productItems.forEach(item => {
                    item.style.display = 'none';
                });

                // Show the product detail
                productDetail.style.display = 'block';

                // Fetch product details
                fetchProductDetails(productId);
            };
        });
    </script>
</head>

<body>
<!--Navigation Bar-->
<?php //include '../Nav Bar/nav.php'; ?>
<div class="product-page">
    <header class="page-header">
        <h1>Our Trainers Collection</h1>
        <!-- These are all the category links, as well as the price filter-->
        <div class="category-links">
            <a href="products-page.php?category=all" class="category-link" data-category="all">All Categories</a>
            <a href="products-page.php?category=trainers" class="category-link" data-category="trainers">Trainers</a>
            <a href="products-page.php?category=basketball-shoes" class="category-link" data-category="basketball-shoes">Basketball Shoes</a>
            <a href="products-page.php?category=football-shoes" class="category-link" data-category="football-shoes">Football Shoes</a>
            <a href="products-page.php?category=running-shoes" class="category-link" data-category="running-shoes">Running Shoes</a>
            <a href="products-page.php?category=gym-shoes" class="category-link" data-category="gym-shoes">Gym Shoes</a>
            <select id="price-sort" onchange="updateSortOrder(this.value);">
                <option value="low_to_high">Price: Low to High</option>
                <option value="high_to_low">Price: High to Low</option>
            </select>
        </div>
    </header>

    <!-- Product detail container -->
    <div class="product-detail" id="product-detail">
        <!-- Product details will be displayed here -->
    </div>

    <!-- Absolutely WHAM code section, but it does 4 things:
        - Connects the database (needs to get changed to the server one since i only hooked it to my local)
        - Helps display product pages dynamically (so basically if a specific product ID is selected,
                                                    it fetches and displays details of that specific product
                                                    via the $_GET parameter)
        - And if no specific product is requested, it displays products by category
        - And finally, it also handles sorting by price if the 'sort_order' $_GET parameter is given-->

    <?php
    // Database connection details
    $host = "localhost";
    $username = "u-230185247";
    $password = "z3mlfs8WdS1hxvH";
    $dbname = "u_230185247_treaker";

    // Create database connection
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetching products based on category and sort order
    $selectedCategory = 'all'; // Default category
    if (isset($_GET['category']) && $_GET['category'] !== '') {
        $selectedCategory = $conn->real_escape_string($_GET['category']);
    }
    $sortOrder = isset($_GET['sort_order']) && $_GET['sort_order'] === 'high_to_low' ? 'DESC' : 'ASC';

    if ($selectedCategory == 'all') {
        $productSql = "SELECT p.product_id, p.name, p.description, p.price, p.image_link, c.name AS category_name
                   FROM product p
                   LEFT JOIN product_category pc ON p.product_id = pc.product_id
                   LEFT JOIN category c ON pc.category_id = c.category_id
                   ORDER BY p.price $sortOrder";
    } else {
        $productSql = "SELECT p.product_id, p.name, p.description, p.price, p.image_link, c.name AS category_name
                   FROM product p
                   LEFT JOIN product_category pc ON p.product_id = pc.product_id
                   LEFT JOIN category c ON pc.category_id = c.category_id
                   WHERE c.name = '$selectedCategory'
                   ORDER BY p.price $sortOrder";
    }

    // Displaying products in a grid layout
    echo "<div class='product-grid'>";

    $productResult = $conn->query($productSql);
    if ($productResult->num_rows > 0) {
        while ($product = $productResult->fetch_assoc()) {
            $categoryName = $product["category_name"] ?? 'unknown-category';
            $categoryNameKebabCase = strtolower(str_replace(' ', '-', $categoryName));
            $categoryClass = "category-" . $categoryNameKebabCase;

            echo "<div class='product-item " . $categoryClass . "' onclick='showProductDetail(" . $product["product_id"] . ")'>";
            echo "<img src='" . $product["image_link"] . "' alt='" . htmlspecialchars($product["name"], ENT_QUOTES) . "' />";
            echo "<div class='product-info'>";
            echo "<h4>" . htmlspecialchars($product["name"], ENT_QUOTES) . "</h4>";
            echo "<p>Price: £" . htmlspecialchars($product["price"], ENT_QUOTES) . "</p>";
            echo "</div>"; // end product-info
            echo "</div>"; // end product-item
        }
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
</div>
<?php
$conn->close();
?>
</body>
</html>
