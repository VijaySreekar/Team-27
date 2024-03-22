<?php
session_start();

require '../AdminPage/AllFunctions/myfunctions.php';
$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_SESSION['authenticated']))
{
    if(isset($_POST['placeOrderButton'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']);
        $user_id = $_SESSION['auth_user']['user_id'];

        if ($name == '' || $email == '' || $phone == '' || $pincode == '' || $address == '')
        {
            echo json_encode(["success" => false, "message" => "Please fill all the fields."]);
        }

        $cartItems = myCartItems();
        $totalPrice = 0;
        foreach ($cartItems as $cartitem)
        {
            $totalPrice += $cartitem['discounted_price'] * $cartitem['quantity'];
        }

        $tracking_no = "treakers".rand(100000, 999999).substr($name, 0, 3);
        $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode,
                    payment_id) VALUES ('$tracking_no', '$user_id', '$name', '$email', '$phone', '$address', '$pincode',
                    '$totalPrice', '$payment_mode', '$payment_id')";
        $insert_result = mysqli_query($conn, $insert_query);

        if($insert_result)
        {
            $order_id = mysqli_insert_id($conn);
            foreach ($cartItems as $cartitem)
            {
                $product_id = $cartitem['product_id'];
                $quantity = $cartitem['quantity'];
                $price = $cartitem['discounted_price'];
                $insert_items_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', $product_id, $quantity, $price)";
                $insert_items_result = mysqli_query($conn, $insert_items_query);
            }

            $delete_cart_query = "DELETE FROM cart WHERE user_id = '$user_id'";
            $delete_cart_result = mysqli_query($conn, $delete_cart_query);

            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
            echo "<script>
                    swal({
                        title: 'Order Placed Successfully!',
                        text: 'Your order has been placed and is being processed.',
                        icon: 'success',
                        button: 'OK',
                    }).then(() => {
                        window.location.href = 'my_orders.php';
                    });
                  </script>";
        }

    }
}
else
{
    header("Location: ../LoginPage/login_page.php");
}
