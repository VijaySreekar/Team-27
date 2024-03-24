<?php
session_start();
include("../../Assets/Database/connectdb.php");

if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $uid = $_SESSION['user_id'];

    $sql = "SELECT * FROM product WHERE product_id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];


    $rating = mysqli_real_escape_string($mysqli, $rating);
    $comment = mysqli_real_escape_string($mysqli, $comment);
    $uid = mysqli_real_escape_string($mysqli, $uid);
    $pid = mysqli_real_escape_string($mysqli, $pid);

    $sql = "INSERT INTO `user_review` (`user_id`, `product_id`, `rating`, `comment`) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iiis", $uid, $pid, $rating, $comment);
    $stmt->execute();


    header("Location: ../../profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave A Review</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link href="../../Assets/CSS/nav.css" rel="stylesheet">
</head>
<body class="bg-gray-200">

<?php include("../../Includes/nav.php"); ?>

<div class="container py-5">
    <h2 class="mb-4">Leave a review for "<?php echo htmlspecialchars($row['name'] ?? ''); ?>"</h2>
    <?php if(isset($row)): ?>
        <div class="card card-body shadow mb-4">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <h4>£<?php echo htmlspecialchars($row['price']); ?></h4>
        </div>
    <?php endif; ?>
    <div class="card card-body shadow">
        <form method="POST" id="reviewForm">
            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea rows="5" name="comment" id="comment" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</div>

<?php include("../../Includes/footer.php"); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
