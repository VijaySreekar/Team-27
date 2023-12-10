
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Details</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .payment-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
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
            background-color: black;
            color: white;
            padding: 5px; /* Add padding to create a strip behind subheadings */
        }

        .payment-form input,
        .payment-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .payment-form button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .invalid-input {
            border: 1px solid red;
        }

        .thank-you-message {
            text-align: center;
            display: none;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <script>
        function validateForm() {
            var inputs = document.querySelectorAll('.payment-form input[required]');
            var isValid = true;

            inputs.forEach(function (input) {
                if (input.value.trim() === '') {
                    isValid = false;
                    input.classList.add('invalid-input');
                    input.setAttribute('title', 'This field is required');
                } else {
                    input.classList.remove('invalid-input');
                    input.removeAttribute('title');
                }
            });

            return isValid;
        }

        function goBack() {
            window.location.href = 'basket.php';
        }
    </script>
</head>
<body>
    <div class="payment-container">
        <?php
        // Check if payment is successful to display thank you message
        if (isset($paymentSuccessful) && $paymentSuccessful) {
            echo '<div class="thank-you-message">';
            echo '<h2>Thank You for Your Order!</h2>';
            echo '<p>Your order has been successfully placed.</p>';
            echo '</div>';
        } else {
            // Show the payment form
        ?>
        <h2>Payment Details</h2>

      
        <div class="payment-section">
            <h3>1. Customer Details</h3>
            <form class="payment-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()">
                <label for="customer_name">Name:</label>
                <input type="text" id="customer_name" name="customer_name" required>

                <label for="customer_surname">Surname:</label>
                <input type="text" id="customer_surname" name="customer_surname" required>

                <label for="street_name">Street Name:</label>
                <input type="text" id="street_name" name="street_name" required>

                <label for="postcode" title="Enter 6 digits/letters">Postcode:</label>
                <input type="text" id="postcode" name="postcode" pattern="[A-Za-z0-9]{6}" required>

            </form>
        </div>

        <div class="payment-section">
            <h3>2. Payment Options</h3>
            <form class="payment-form" action="process_payment.php" method="post" onsubmit="return validateForm()">
                <label for="card_number" title="Enter 16 digits of your card">Card Number:</label>
                <input type="text" id="card_number" name="card_number" pattern="\d{16}" required>

                <label for="cvv" title="Enter 3 digits">CVV:</label>
                <input type="text" id="cvv" name="cvv" pattern="\d{3}" required>

                <label for="cardholder_name">Cardholder Name:</label>
                <input type="text" id="cardholder_name" name="cardholder_name" required>

                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="card">Credit/Debit Card</option>
                    <option value="apple_pay">Apple Pay</option>
                    <option value="paypal">PayPal</option>
                </select>

                <!-- Apple Pay and PayPal buttons -->
                <img src="apple_pay_icon.png" alt="Apple Pay" width="50" height="50">
                <img src="paypal_icon.png" alt="PayPal" width="50" height="50">

                <button type="submit">Place Order</button>
            </form>
        </div>
        <?php } ?>

        <!-- Back Button -->
        <button class="back-button" onclick="goBack()">Back to Basket</button>
    </div>
</body>
</html>
