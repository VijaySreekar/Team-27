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

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}


?>

