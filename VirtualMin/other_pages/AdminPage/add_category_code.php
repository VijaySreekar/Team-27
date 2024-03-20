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
    $status = ($_POST['status'] == "1") ? 1 : 0;
    $popular = ($_POST['popular'] == "1") ? 1 : 0;
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
            $_SESSION['message'] = "Category Added";
            header('Location: adminpage.php');
            exit();
        } else {
            $_SESSION['message'] = "Error moving file";
            header('Location: add_category.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "Category Not Added";
        header('Location: add_category.php');
        exit();
    }
}
else if(isset($_POST['save_categorybtn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = ($_POST['status'] == "1") ? 1 : 0;
    $popular = ($_POST['popular'] == "1") ? 1 : 0;

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        $update_filename = $new_image;
    }
    else
    {
        $update_filename = $old_image;
    }

    $path = __DIR__ . "/";
    $update_query = "UPDATE category SET name = '$name', slug = '$slug', description = '$description', image = '$update_filename', 
                    meta_title = '$meta_title', meta_description = '$meta_description', meta_keywords = '$meta_keywords',
                    status = '$status', popular = '$popular' WHERE category_id = $category_id";

    $update_query_run = mysqli_query($conn, $update_query);

    if($update_query_run)
    {
        if ($_FILES['image']['name'] != "") {
            $destination = $path . $update_filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if (file_exists($path . $old_image)) {
                unlink($path . $old_image);
            }
        }
        $_SESSION['message'] = "Category Updated";
        header('Location: edit-category.php?id=$category_id');
        exit();
    }
    else
    {
        redirect("edit-category.php?id=$category_id", "Category Not Updated");
    }
}
else if(isset($_POST['delete_categorybtn']))
{
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $delete_query = "DELETE FROM category WHERE category_id = $category_id";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run)
    {
        $_SESSION['message'] = "Category Deleted";
        header('Location: category.php?id=$category_id');
        exit();
    }
    else
    {
        $_SESSION['message'] = "Category Not Deleted, Something went wrong!";
        header('Location: category.php?id=$category_id');
        exit();
    }
}
?>