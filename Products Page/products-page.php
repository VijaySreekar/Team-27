<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treakers</title>
    <!-- favicon goes here -->
    <link rel="icon" type="image/x-icon" href="">
    <!-- css style sheet goes here -->
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
    <div class="product-page">
        <header class="page-header">
            <h1>Our Trainers Collection</h1>
        </header>
        <section class="product-grid">
            <?php
                include ("connectdb-script.php");
            ?>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>
