<?php

session_start();

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
    if(isset($_POST['scope']))
    {
        $scope = $_POST['scope'];
        switch ($scope)
        {
            case "add":
                $product_id = $_POST['product_id'];
                $product_quantity = $_POST['quantity'];

                $user_id = $_SESSION['auth_user']['user_id'];

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
