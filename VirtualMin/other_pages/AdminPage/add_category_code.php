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
        header("Location: edit-category.php?id=$category_id");
        exit();
    }
    else
    {
        $_SESSION['message'] = "Category Not Updated";
        header("Location: edit-category.php?id=$category_id");
    }
}
else if(isset($_POST['delete_categorybtn']))
{
    $category_id = mysqli_real_escape_string($conn, $_POST['category_ids']);

    $delete_query = "DELETE FROM category WHERE category_id = $category_id";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run)
    {
//        $_SESSION['message'] = "Category Deleted";
//        header('Location: category.php');
//        exit();
        echo 200;
    }
    else
    {
//        $_SESSION['message'] = "Category Not Deleted";
//        header('Location: category.php');
//        exit();
        echo 500;
    }

}
else if(isset($_POST['addproduct_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];
    $quantity = $_POST['quantity'];
    $status = ($_POST['status'] == "1") ? 1 : 0;
    $trending = ($_POST['trending'] == "1") ? 1 : 0;

    $image = $_FILES['image']['name'];

    $path = __DIR__ . "/"; // Path to the directory containing the PHP script

    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . "_" . $image;

    if($category_id != "" && $name != "" && $slug != "" && $description != "" && $original_price != "" && $discounted_price != "" && $quantity != "" && $status != "" && $trending != "" && $image != "")
    {
        $product_query = "INSERT INTO product (category_id, name, slug, description, image, original_price, discounted_price, quantity, status, trending) 
        VALUES ('$category_id', '$name', '$slug', '$description', '$filename', '$original_price', '$discounted_price', '$quantity', '$status', '$trending')";

        $product_query_run = mysqli_query($conn, $product_query);

        if($product_query_run)
        {
            $destination = $path . $filename;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $destination))
            {
                $_SESSION['message'] = "Product Added";
                header('Location: allproducts.php');
                exit();
            }
            else
            {
                $_SESSION['message'] = "Error moving file";
                header('Location: add_productsss.php');
                exit();
            }
        }
        else
        {
            $_SESSION['message'] = "Product Not Added";
            header('Location: add_products.php');
            exit();
        }
    }
    else
    {
        $_SESSION['message'] = "Please fill all the fields";
        header('Location: add_products.php');
        exit();
    }
}
else if(isset($_POST['editproduct_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];
    $quantity = $_POST['quantity'];
    $status = ($_POST['status'] == "1") ? 1 : 0;
    $trending = ($_POST['trending'] == "1") ? 1 : 0;

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    $path = __DIR__ . "/";

    if($new_image != "")
    {

        $update_filename = $new_image;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE product SET category_id = '$category_id', name = '$name', description = '$description', image = '$update_filename', 
                    original_price = '$original_price', discounted_price = '$discounted_price', quantity = '$quantity', status = '$status', trending = '$trending' WHERE product_id = $product_id";
    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if($update_product_query_run)
    {
        if ($_FILES['image']['name'] != "") {
            $destination = $path . $update_filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if (file_exists($path . $old_image)) {
                unlink($path . $old_image);
            }
        }
        $_SESSION['message'] = "Product Updated";
        header("Location: edit-product.php?id=$product_id");
        exit();
    }
    else
    {
        $_SESSION['message'] = "Product Not Updated";
        header("Location: edit-product.php?id=$product_id");

    }
}
else if(isset($_POST['deleteproduct_btn']))
{
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $product_delete_query = "DELETE FROM product WHERE product_id = $product_id";
    $product_delete_query_run = mysqli_query($conn, $product_delete_query);

    if($product_delete_query_run)
    {
//        $_SESSION['message'] = "Product Deleted Successfully";
//        header('Location: category.php');
//        exit();
        echo 200;
    }
    else
    {
//        $_SESSION['message'] = "Category Not Deleted";
//        header('Location: category.php');
//        exit();
        echo 500;
    }
}
else
{
    header('Location: adminpage.php');
}
?>