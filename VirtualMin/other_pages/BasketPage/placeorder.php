<?php
session_start();

require '../../Assets/Functions/myfunctions.php';
include '../../Assets/Database/connectdb.php';

if(isset($_SESSION['authenticated']))
{
    if(isset($_POST['placeOrderButton'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']); //Undefined
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

        if ($insert_result) {
            $order_id = mysqli_insert_id($conn);
            $allItemsAvailable = true; // Assume all items are available at the start

            foreach ($cartItems as $cartitem) {
                $product_id = $cartitem['product_id'];
                $quantity = $cartitem['quantity'];

                // Check stock availability
                $product_query = "SELECT quantity FROM product WHERE product_id = '$product_id' LIMIT 1";
                $product_result = mysqli_query($conn, $product_query);
                $product_data = mysqli_fetch_assoc($product_result);
                $current_stock = $product_data['quantity'];

                if ($current_stock >= $quantity) { // Sufficient stock available
                    $price = $cartitem['discounted_price'];
                    $insert_items_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', $product_id, $quantity, $price)";
                    $insert_items_result = mysqli_query($conn, $insert_items_query);

                    $new_stock = $current_stock - $quantity;
                    $update_stock_query = "UPDATE product SET quantity = '$new_stock' WHERE product_id = '$product_id'";
                    $update_stock_result = mysqli_query($conn, $update_stock_query);
                } else {
                    $allItemsAvailable = false;
                    break;
                }
            }

            if ($allItemsAvailable) {
                $delete_cart_query = "DELETE FROM cart WHERE user_id = '$user_id'";
                $delete_cart_result = mysqli_query($conn, $delete_cart_query);

                echo 201;
            } else {
                echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
                echo "<script>
                swal({
                    title: 'Order Not Placed!',
                    text: 'One or more items in your cart are out of stock or unavailable in the desired quantity.',
                    icon: 'error',
                    button: 'OK',
                }).then(() => {
                    window.location.href = 'cart.php'; // Redirect back to cart for review
                });
              </script>";
            }
        }


    }
}
else
{
    header("Location: ../LoginPage/login_page.php");
}