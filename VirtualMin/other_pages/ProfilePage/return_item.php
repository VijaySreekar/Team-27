<?php
session_start();
include("../../connectdb.php");

if (!isset($_SESSION['user_id'])) {
    header('Location: ../LoginPage/login_page.php');
    exit();
}


$order_id = $product_id = $reason = "";
$returnSuccess = $returnError = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = htmlspecialchars($_GET['order_id']);
    $product_id = htmlspecialchars($_GET['product_id']);
    $reason = htmlspecialchars($_POST['reason']);


    $sql = "UPDATE order_history SET return_reason = ?, status = 'Returned' WHERE order_id = ? AND product_id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sii", $reason, $order_id, $product_id);

        if ($stmt->execute()) {
            $returnSuccess = "Product has been successfully returned.";
        } else {
            $returnError = "Error in returning the product. Please try again.";
        }

        $stmt->close();
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Product</title>
    <!-- <link rel="stylesheet" href="Add the CSS code later"> -->
</head>
<body>
    <div class="return-form-container">
        <h2>Product Return Form</h2>
        <?php if (!empty($returnSuccess)) echo "<div class='success-message'>" . $returnSuccess . "</div>"; ?>
        <?php if (!empty($returnError)) echo "<div class='error-message'>" . $returnError . "</div>"; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?order_id=" . htmlspecialchars($_GET['order_id']) . "&product_id=" . htmlspecialchars($_GET['product_id']); ?>" method="post">
            <div class="form-group">
                <label for="reason">Why are you returning this product?</label>
                <textarea id="reason" name="reason" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="return">Return Product</button>
            </div>
        </form>
    </div>
</body>
</html>
