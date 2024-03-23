    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Treakers</title>
        <link rel="icon" type="image/x-icon" href="">
        <link rel="stylesheet" type="text/css" href="productstyles.css">
        <link rel="stylesheet" href="../NavBar_Footer/nav.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            .pagination {
                display: flex;
                justify-content: center;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .pagination a {
                color: #333;
                padding: 8px 16px;
                text-decoration: none;
                transition: background-color 0.3s;
                border: 1px solid #ccc;
                margin: 0 5px;
                border-radius: 5px;
            }

            .pagination a.active {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
            }

            .pagination a:hover:not(.active) {
                background-color: #ddd;
            }

            .main-container {
                display: flex;
                flex-direction: column;
                gap: 20px; /* Adds spacing between sections */
                min-height: 100vh; /* Ensures the footer stays at the bottom */
            }

        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const categoryLinks = document.querySelectorAll('.category-link');
                const productItems = document.querySelectorAll('.product-item');
                const productDetail = document.querySelector('.product-detail');

                productDetail.style.display = 'none';

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

            // This function gets the selected category from the category links
            function getSelectedCategory() {
                const categoryLinks = document.querySelectorAll('.category-link');
                for (const link of categoryLinks) {
                    if (link.classList.contains('active')) {
                        return link.getAttribute('data-category');
                    }
                }
                return 'all'; // Default to 'all' if no category is selected
            }


            function sortProducts(sortOrder) {
                const selectedCategory = getSelectedCategory();
                const productItems = document.querySelectorAll('.product-item');
                const productGrid = document.querySelector('.product-grid');


                const productArray = Array.from(productItems);

                productArray.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('Price: £', ''));
                    const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('Price: £', ''));

                    if (sortOrder === 'low_to_high') {
                        return priceA - priceB;
                    } else {
                        return priceB - priceA;
                    }
                });


                productGrid.innerHTML = '';


                for (const product of productArray) {
                    productGrid.appendChild(product);
                }
            }


            function updateSortOrder(sortOrder) {
                sortProducts(sortOrder);
            }

            window.showProductDetail = function(productId) {
                $.ajax({
                    url: 'fetch_product_details.php?product_id=' + productId,
                    type: 'GET',
                    success: function(response) {

                        $('.product-detail').html(response);


                        $('.product-detail-button').on('click', function() {
                            var quantity = 1;
                            $.ajax({
                                url: 'fetch_product_details.php?action=add_to_cart&product_id=' + productId + '&quantity=' + quantity,
                                type: 'GET',
                                success: function(cartResponse) {
                                    console.log('Cart updated:', cartResponse);
                                },
                                error: function() {
                                    alert('Error adding to cart');
                                }
                            });
                        });
                    },
                    error: function() {
                        alert('Failed to fetch product details.');
                    }
                });
            };

            function addToCart(productId, quantity) {
                $.ajax({
                    url: 'fetch_product_details.php',
                    type: 'GET',
                    data: { 'action': 'add_to_cart', 'product_id': productId, 'quantity': quantity },
                    success: function(response) {
                        alert("Product added to cart!");
                    },
                    error: function() {
                        alert("Error adding product to cart.");
                    }
                });
            }
        </script>
    </head>

    <body>
        <div class="main-container">
            <header>
                <?php include '../NavBar_Footer/nav.php'; ?>
            </header>
            <section class="product-page">
                <header class="page-header">
                    <h1>Our Trainers Collection</h1>
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
                $selectedCategory = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : 'all';
                $sortOrder = isset($_GET['sort_order']) && $_GET['sort_order'] === 'high_to_low' ? 'DESC' : 'ASC';

                // Pagination
                $itemsPerPage = 12; // Adjust as needed
                $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $offset = ($currentPage - 1) * $itemsPerPage;

                if ($selectedCategory == 'all') {
                    $productSql = "SELECT p.product_id, p.name, p.description, p.price, p.image_link, c.name AS category_name
                       FROM product p
                       LEFT JOIN product_category pc ON p.product_id = pc.product_id
                       LEFT JOIN category c ON pc.category_id = c.category_id
                       ORDER BY p.price $sortOrder
                       LIMIT $offset, $itemsPerPage";
                } else {
                    $productSql = "SELECT p.product_id, p.name, p.description, p.price, p.image_link, c.name AS category_name
                       FROM product p
                       LEFT JOIN product_category pc ON p.product_id = pc.product_id
                       LEFT JOIN category c ON pc.category_id = c.category_id
                       WHERE c.name = '$selectedCategory'
                       ORDER BY p.price $sortOrder
                       LIMIT $offset, $itemsPerPage";
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
                        echo "<p class='product-price'>Price: £" . htmlspecialchars($product["price"], ENT_QUOTES) . "</p>";
                        echo "<button onclick='addToCart(" . $product["product_id"] . ", 1)'>Add to Cart</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
                ?>
            </section>
            <section class="pagination-section">
                <?php
                // Pagination links
                $totalProductsSql = "SELECT COUNT(*) AS total FROM product";
                $totalResult = $conn->query($totalProductsSql);
                $totalProducts = $totalResult->fetch_assoc()['total'];
                $totalPages = ceil($totalProducts / $itemsPerPage);

                echo "<div class='pagination'>";
                if ($currentPage > 1) {
                    echo "<a href='products-page.php?category=$selectedCategory&page=" . ($currentPage - 1) . "' class='prev'>Previous</a>";
                }
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<a href='products-page.php?category=$selectedCategory&page=$i' class='" . ($i == $currentPage ? 'active' : '') . "'>$i</a>";
                }
                if ($currentPage < $totalPages) {
                    echo "<a href='products-page.php?category=$selectedCategory&page=" . ($currentPage + 1) . "' class='next'>Next</a>";
                }
                echo "</div>";
                ?>
                <?php
                $conn->close();
                ?>
            </section>
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
        </div>
    </body>
    </html>
