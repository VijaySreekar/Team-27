<?php

session_start();

include '../../Assets/Database/connectdb.php';

if(isset($_SESSION['authenticated']))
{
    if(isset($_POST['scope']))
    {
        $scope = $_POST['scope'];
        switch ($scope)
        {
            case "add":
                $product_id = $_POST['product_id'];
                $product_quantity = $_POST['quantity'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $check_existing_cart = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $check_result = mysqli_query($conn, $check_existing_cart);

                if(mysqli_num_rows($check_result) > 0)
                {
                    echo 'existing';
                }
                else
                {
                    $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$product_quantity')";
                    $insert_result = mysqli_query($conn, $insert_query);

                    if ($insert_result)
                    {
                        echo 201;
                    }
                    else
                    {
                        echo 500;
                    }
                }

                break;
            case "update":
                $product_id = $_POST['product_id'];
                $product_quantity = $_POST['quantity'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $check_existing_cart = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $check_result = mysqli_query($conn, $check_existing_cart);

                if(mysqli_num_rows($check_result) > 0)
                {
                    $update_query = "UPDATE cart SET quantity = '$product_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
                    $update_result = mysqli_query($conn, $update_query);
                    if($update_result)
                    {
                        echo 200;
                    }
                    else
                    {
                        echo 500;
                    }
                }
                else
                {
                    echo 'not_existing';
                }

                break;
            case "delete":
                $cart_id = $_POST['cart_id'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $delete_query = "DELETE FROM cart WHERE id = '$cart_id' AND user_id = '$user_id'";
                $delete_result = mysqli_query($conn, $delete_query);

                if($delete_result) {
                    if(mysqli_affected_rows($conn) > 0) {
                        echo 200; // Successfully deleted
                    } else {
                        echo 'not_existings'; // No rows were affected, meaning the cart item didn't exist
                    }
                } else {
                    echo 500; // Query execution failed
                }

                break;
            default:
                echo 500;

        }
    }
}
else
{
    echo 401;
}
?>
