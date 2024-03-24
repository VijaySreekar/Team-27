<?php

$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}

function getItembyID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE category_id = $id";
    return $query_run = mysqli_query($conn, $query);
}

function getItemActive($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status = '1' AND category_id = $id";
    return $query_run = mysqli_query($conn, $query);
}

function getProductCategory($category_id)
{
    global $conn;
    $query = "SELECT * FROM product WHERE category_id = $category_id AND status = '1' ";
    return $query_run = mysqli_query($conn, $query);
}

function getSlugActive($table, $slug)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE slug = '$slug' AND status = '1' LIMIT 1";
    return $query_run = mysqli_query($conn, $query);
}

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status = '1' ";
    return $query_run = mysqli_query($conn, $query);
}
function getProductItembyID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE product_id = $id";
    return $query_run = mysqli_query($conn, $query);
}

function myCartItems()
{
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.product_id, c.quantity, p.product_id as pid, p.name, p.image, p.discounted_price
            FROM cart c, product p WHERE c.product_id = p.product_id AND c.user_id = '$user_id' ORDER BY c.id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function myOrders()
{
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * from orders WHERE user_id = '$user_id' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function checkTrackingNo($tracking_no)
{
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE tracking_no = '$tracking_no' AND user_id = '$user_id'";
    return mysqli_query($conn, $query);
}

function AdmincheckTrackingNo($tracking_no)
{
    global $conn;
    $query = "SELECT * FROM orders WHERE tracking_no = '$tracking_no'";
    return mysqli_query($conn, $query);
}

function getAllOrders() {
    global $conn;
    // Corrected the JOIN condition here
    $query = "SELECT * FROM orders  WHERE status < '3' ORDER BY id DESC";
    return mysqli_query($conn, $query);
}

function getOrderHistory()
{
    global $conn;
    $query = "SELECT * FROM orders  WHERE status >= '2' ORDER BY id DESC";
    return mysqli_query($conn, $query);

}

function getAllTrending()
{
    global $conn;
    $query = "SELECT * FROM product WHERE trending = '1' AND status = '1' ";
    return mysqli_query($conn, $query);
}


//function redirect($url, $message)
//{
//    $_SESSION['message'] = $message;
//    header('Location: ' . $url);
//    exit();
//}

?>