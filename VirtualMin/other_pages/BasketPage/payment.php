<<<<<<< Updated upstream
<?php 
    include "../../connectdb.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Your Profile</title>
        <link rel="stylesheet" href="../ProfilePage/profile.css">
        <link rel="stylesheet" href="../NavBar/nav.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <?php 
            include("../NavBar/navbar.php");
            
            $sql="INSERT INTO order_history (user_id, product_id, date) VALUES ('')";
            $result = mysqli_query($mysqli, $sql);

        ?>
        <div class="container">
            Your order has been placed. Thank you!
        </div>
    </body>
</html>
=======
<?php
session_start();

// Create database connection
$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";
$conn = mysqli_connect($host, $username, $password, $dbname);

$paymentSuccessful = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $customer_name = isset($_POST['customer_name']) ? $conn->real_escape_string($_POST['customer_name']) : '';
    $customer_surname = isset($_POST['customer_surname']) ? $conn->real_escape_string($_POST['customer_surname']) : '';
    $street_name = isset($_POST['street_name']) ? $conn->real_escape_string($_POST['street_name']) : '';
    $postcode = isset($_POST['postcode']) ? $conn->real_escape_string($_POST['postcode']) : '';

    // Check if user_id is set in the session
    if (!isset($_SESSION['user_id'])) {
        echo "User not logged in.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');

    // Insert customer address details into the database
    $sql_address = "INSERT INTO address (address_line1, postcode) VALUES ('$street_name', '$postcode')";
    if ($conn->query($sql_address) === TRUE) {
        $address_id = $conn->insert_id;

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                // Modified to exclude address_id
                $sql_order = "INSERT INTO order_history (user_id, product_id, date) VALUES ('$user_id', '$product_id', '$date')";
                if (!$conn->query($sql_order)) {
                    echo "Error: " . $sql_order . "<br>" . $conn->error;
                }
            }
            $paymentSuccessful = true;
            unset($_SESSION['cart']);
        } else {
            echo "Cart is empty.";
        }
    } else {
        echo "Error: " . $sql_address . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Details</title>
</head>
<body>
<div class="payment-container">
    <?php
    if ($paymentSuccessful) {
        // Display thank you message
        echo "<div class='thank-you-message'>";
        echo "<h2>Thank you for your order!</h2>";
        echo "<p>Your order has been placed successfully.</p>";
    } else {
        echo "<h2>Payment Details</h2>";
    }
    ?>
</div>
</body>
</html>
>>>>>>> Stashed changes
