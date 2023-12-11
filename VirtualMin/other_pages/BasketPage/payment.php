<?php
session_start();

// Create database connection
$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";
$conn = mysqli_connect($host, $username, $password, $dbname);

$paymentSuccessful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['payment_form'])) {
        $paymentSuccessful = true; // For demonstration purposes, set to true
    } else {
        $customer_name = isset($_POST['customer_name']) ? $conn->real_escape_string($_POST['customer_name']) : '';
        $customer_surname = isset($_POST['customer_surname']) ? $conn->real_escape_string($_POST['customer_surname']) : '';
        $street_name = isset($_POST['street_name']) ? $conn->real_escape_string($_POST['street_name']) : '';
        $postcode = isset($_POST['postcode']) ? $conn->real_escape_string($_POST['postcode']) : '';

        if (!isset($_SESSION['user_id'])) {
            echo "User not logged in.";
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $date = date('Y-m-d H:i:s');

        $sql_address = "INSERT INTO address (address_line1, postcode) VALUES ('$street_name', '$postcode')";
        if ($conn->query($sql_address) === TRUE) {
            $address_id = $conn->insert_id;

            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    $sql_order = "INSERT INTO order_history (user_id, product_id, address_id, date) VALUES ('$user_id', '$product_id', '$address_id', '$date')";
                    if (!$conn->query($sql_order)) {
                        echo "Error: " . $sql_order . "<br>" . $conn->error;
                    }
                }
                header("Location: payment.php");
                exit;
            } else {
                echo "Cart is empty.";
            }
        } else {
            echo "Error: " . $sql_address . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../NavBar/nav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../../Images/R7ef87d51280cfed5edee29357c97b19d.jpeg');
            background-size: cover;
            background-blur: 5px;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .payment-container {
            background-color: rgba(166, 165, 165, 0.89);
            margin-top: 90px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .payment-section {
            margin-bottom: 20px;
        }



        .payment-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
        }

        .payment-form input,
        .payment-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .payment-form button {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        .payment-form button:hover {
            background-color: #0056b3;
        }


        .thank-you-message {
            text-align: center;
        }

        .back-button {
            background-color: #ccc;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-top: 20px;
            font-size: 18px;
        }

        .back-button:hover {
            background-color: #999;
        }


        /*FOOTER*/
        .fcontainer{
            max-width: 1170px;
            margin:auto;
        }
        .row{
            display: flex;
            flex-wrap: wrap;
        }

        ul{
            list-style: none;
        }
        .footer{
            background-color: #0c6291;
            padding: 20px 0;
            position: absolute;
            top: 1100px;
            width: 100%;
        }

        .footer-col{
            width: 25%;
            padding: 0 15px;
        }

        .footer-col h4{
            font-size: 18px;
            color: #ffffff;
            text-transform: capitalize;
            margin-bottom: 35px;
            font-weight: 500;
            position: relative;
        }
        .footer-col h4::before{
            content: '';
            position: absolute;
            left:0;
            bottom: -10px;
            background-color: #a63446;
            height: 2px;
            box-sizing: border-box;
            width: 50px;
        }
        .footer-col ul li:not(:last-child){
            margin-bottom: 10px;
        }
        .footer-col ul li a{
            font-size: 16px;
            text-transform: capitalize;
            color: #ffffff;
            text-decoration: none;
            font-weight: 300;
            color: #bbbbbb;
            display: block;
            transition: all 0.3s ease;
        }
        .footer-col ul li a:hover{
            color: #ffffff;
            padding-left: 8px;
        }
        .footer-col .social-links a{
            display: inline-block;
            height: 40px;
            width: 40px;
            background-color: rgba(255,255,255,0.2);
            margin:0 10px 10px 0;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: #ffffff;
            transition: all 0.5s ease;
        }
        .footer-col .social-links a:hover{
            color: #24262b;
            background-color: #ffffff;
        }

        @media(max-width: 767px){
            .footer-col{
                width: 50%;
                margin-bottom: 30px;
            }
        }
        @media(max-width: 574px){
            .footer-col{
                width: 100%;
            }
        }
    </style>
    <script>
        function validateForm() {
            var elements = document.querySelectorAll('.payment-form .required');
            var isValid = true;

            elements.forEach(function (element) {
                if (element.value.trim() === '') {
                    isValid = false;
                    element.classList.add('invalid-input');
                    element.setAttribute('title', 'This field is required');
                } else {
                    element.classList.remove('invalid-input');
                    element.removeAttribute('title');
                }
            });

            console.log('Form is valid:', isValid);

            return isValid;
        }

        function goBack() {
            window.location.href = 'basket.php';
        }
    </script>
</head>
<body>
<?php
include "../NavBar/nav.php";
?>
<div class="container">
    <div class="payment-container">
        <?php
        if ($paymentSuccessful) {
            echo '<div class="thank-you-message">';
            echo '<h2>Thank You for Your Order!</h2>';
            echo '<p>Your order has been successfully placed.</p>';
            echo '</div>';
        } else {
            echo '<h2 style="text-align: center;">Payment Details</h2>';
            echo '<div class="payment-section">';
            echo '<h3>1. Customer Details</h3>';
            echo '<form class="payment-form" action="' . $_SERVER['PHP_SELF'] . '" method="post" onsubmit="return validateForm()">';
            echo '<label for="customer_name">Name:</label>';
            echo '<input type="text" id="customer_name" name="customer_name" class="required">';

            echo '<label for="customer_surname">Surname:</label>';
            echo '<input type="text" id="customer_surname" name="customer_surname" class="required">';
            echo '<label for="street_name">Street Name:</label>';
            echo '<input type="text" id="street_name" name="street_name" class="required">';
            echo '<label for="postcode">Postcode:</label>';
            echo '<input type="text" id="postcode" name="postcode" class="required">';

            echo '<h3>2. Payment Details</h3>';
            echo '<label for="card_number">Card Number:</label>';
            echo '<input type="text" id="card_number" name="card_number" class="required">';
            echo '<label for="cvv">CVV:</label>';
            echo '<input type="text" id="cvv" name="cvv" class="required">';
            echo '<label for="expiry_date">Expiry Date:</label>';
            echo '<input type="text" id="expiry_date" name="expiry_date" class="required">';

            echo '<button type="submit" name="payment_form">Pay Now</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>

        <button class="back-button" onclick="goBack()">Back to Basket</button>
    </div>
</div>
</body>
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
</html>
