<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treakers</title>
    <link rel="icon" type="image/x-icon" href="">
    <link rel="stylesheet" type="text/css" href="styles.css">

    <!-- The script below basically works so that when a category link is clicked, it loops 
    through all product categories and either shows or hides them based on whether their 
    ID matches the selected category (and if all is selected, then all are shown)-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryLinks = document.querySelectorAll('.category-link');
            const categories = document.querySelectorAll('.product-category');

            categoryLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const selectedCategory = this.getAttribute('data-category');
                    categories.forEach(category => {
                        if (selectedCategory === 'all' || category.id === 'category-' + selectedCategory) {
                            category.style.display = '';
                        } else {
                            category.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</head>


<body>
    <div class="product-page">
        <header class="page-header">
            <h1>Our Trainers Collection</h1>
            <!-- These are all the category links, as well as the price filter-->
            <div class="category-links">
                <a href="products-page.php?category=all" class="category-link">All Categories</a>
                <a href="products-page.php?category=trainers" class="category-link">Trainers</a>
                <a href="products-page.php?category=basketball-shoes" class="category-link">Basketball Shoes</a>
                <a href="products-page.php?category=football-shoes" class="category-link">Football Shoes</a>
                <a href="products-page.php?category=running-shoes" class="category-link">Running Shoes</a>
                <a href="products-page.php?category=gym-shoes" class="category-link">Gym Shoes</a>
                <select id="price-sort" onchange="updateSortOrder(this.value);">
                    <option value="low_to_high">Price: Low to High</option>
                    <option value="high_to_low">Price: High to Low</option>
                </select>
            </div>
        </header>


        <!-- Absolutely WHAM code section, but it does 4 things:
            - Connects the database (needs to get changed to the server one since i only hooked it to my local)
            - Helps display product pages dynamically (so basically if a specific product ID is selected,
                                                        it fetches and displays details of that specific product 
                                                        via the $_GET parameter)
            - And if no specific product is requested, it displays products by category
            - And finally, it also handles sorting by price if the 'sort_order' $_GET parameter is given-->
        <?php
        $dbhost = "localhost";
        $dbusername = "u-230185247";
        $dbpassword = "z3mlfs8WdS1hxvH";
        $dbname = "u_230185247_treaker";
        $conn = new mysqli($dbhost, $dbname, $dbusername, $dbpassword);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $detailSql = "SELECT * FROM product WHERE product_id = $product_id";
            $detailResult = $conn->query($detailSql);
            if ($detailResult->num_rows > 0) {
                $product = $detailResult->fetch_assoc();
                echo "<div class='product-detail'>";
                echo "<img src='" . $product["image_link"] . "' alt='" . $product["name"] . "' width='200' height='190' />";
                echo "<div class='product-info'>";
                echo "<h2>" . $product["name"] . "</h2>";
                echo "<p>Price: £" . $product["price"] . "</p>";
                echo "<p>Description: " . $product["description"] . "</p>";
                echo "</div>"; 
                echo "</div>"; 
            } else {
                echo "Product not found.";
            }
        } else {
            $selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';
            $sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'low_to_high';
        
            $categorySql = "SELECT * FROM category";
            $categoryResult = $conn->query($categorySql);
        
            if ($categoryResult->num_rows > 0) {
                while ($category = $categoryResult->fetch_assoc()) {
                    $categoryName = $category['name'];
                    $categoryId = $category['category_id'];
                    $formattedCategory = strtolower(str_replace(' ', '-', $categoryName));
        
                    if ($selectedCategory == 'all' || $selectedCategory == $formattedCategory) {
                        echo "<div class='product-category' id='category-$formattedCategory'>";
                        echo "<h3>" . ucfirst($categoryName) . "</h3>";
                        echo "<div class='product-items'>";
        
                        $productSql = "SELECT product_id, name, description, price, image_link FROM product WHERE category_id = $categoryId";
                        $productSql .= $sortOrder === 'low_to_high' ? ' ORDER BY price ASC' : ' ORDER BY price DESC';
                        $productResult = $conn->query($productSql);
        
                        if ($productResult->num_rows > 0) {
                            while ($product = $productResult->fetch_assoc()) {
                                echo "<a href='products-page.php?product_id=" . $product["product_id"] . "' class='product-item' data-category='$formattedCategory'>";
                                echo "<img src='" . $product["image_link"] . "' alt='" . $product["name"] . "' width='200' height='190' />";
                                echo "<h4>" . $product["name"] . "</h4>";
                                echo "<p>Price: £" . $product["price"] . "</p>";
                                echo "</a>"; 
                            }
                        } else {
                            echo "<p>No items in this category.</p>";
                        }
        
                        echo "</div>"; 
                        echo "</div>"; 
                    }
                }
            } else {
                echo "No categories found";
            }
        }
        $conn->close();
        ?>

        <!-- This code section manages the price sorting functionality, so it basically sets the value
        of the price sorting dropdown based on the current URL parameter. It also lets the user change the sorting order
        bc of an event listener, and then reconstructs the url so it displays right-->

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('price-sort');
            var currentSortOrder = new URLSearchParams(window.location.search).get('sort_order');
            if (currentSortOrder) {
                sortSelect.value = currentSortOrder;
            }
            sortSelect.addEventListener('change', function() {
                updateSortOrder(this.value);
            });
        });
        function updateSortOrder(sortOrder) {
            var currentCategory = new URLSearchParams(window.location.search).get('category');
            var newUrl = 'products-page.php?';
            if (currentCategory) {
                newUrl += 'category=' + currentCategory + '&';
            }
            newUrl += 'sort_order=' + sortOrder;
            window.location.href = newUrl;
            }
            </script>


    </div>
</body>
</html>