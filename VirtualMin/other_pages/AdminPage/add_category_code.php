<?php
session_start();

$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_categorybtn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? 1 : 0;
    $popular = isset($_POST['popular']) ? 1 : 0;
    $image = $_FILES['image']['name'];

    $path = __DIR__ . "/"; // Path to the directory containing the PHP script

    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . "_" . $image;

    $category_query = "INSERT INTO category (name, slug, description, image, meta_title, meta_description, meta_keywords, status, popular) 
        VALUES ('$name', '$slug', '$description', '$filename', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular')";

    $category_query_run = mysqli_query($conn, $category_query);

    if ($category_query_run) {
        $destination = $path . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $_SESSION['success'] = "Category Added";
            header('Location: adminpage.php');
            exit();
        } else {
            $_SESSION['status'] = "Error moving file";
            header('Location: add_category.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "Category Not Added";
        header('Location: add_category.php');
        exit();
    }
}
?>
