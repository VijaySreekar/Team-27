
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Product to Review</title>
    <!-- Include Bootstrap CSS and other necessary styles -->
</head>
<body>
<div class="container">
    <h2>Select a product to review</h2>
    <?php foreach ($products as $product): ?>
        <div>
            <a href="../ReviewPage/review.php?orderId=<?= $order_id ?>&productId=<?= $product['product_id'] ?>">
                <?= htmlspecialchars($product['name']) ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
