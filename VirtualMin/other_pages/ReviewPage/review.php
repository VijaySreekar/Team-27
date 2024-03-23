<?php
    session_start(); // Start the session
    include("../../connectdb.php");

    if(isset($_GET['pid'])){
        require_once "../../connectdb.php";

        $pid = $_GET['pid'];
        $uid = $_SESSION['user_id'];

    	$sql = "SELECT * 
        		FROM product 
                WHERE product_id='$pid'";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($result);    
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
    	require_once "../../connectdb.php";
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
		
    	//$rating = mysql_real_escape_string($rating);
		//$comment  = mysql_real_escape_string($comment);
    	//$uid = mysql_real_escape_string($uid);
		//$pid = mysql_real_escape_string($pid);

        $sql = "INSERT INTO `user_review` 
         		(`user_id`, `product_id`, `rating`, `comment`) 
         		VALUES ('$uid', '$pid', '$rating', '$comment')";
    	 
        $result = mysqli_query($mysqli, $sql) or die("bad query");
        //$stmt = $mysqli->stmt_init();

        // if(!$stmt->prepare($sql)){
        //     die("SQL error:".$mysqli->error);
        // }

        // $stmt->bind_param("iiis",
        //                    $_SESSION['user_id'],
        //                    $pid,
        //                    $_POST["rating"],
        //                    $_POST["comment"]);
        // $stmt->execute();

        //header("Location:../../profile.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Leave A Review</title>
        <link rel="stylesheet" href="review.css">
        <link rel="stylesheet" href="../NavBar_Footer/nav.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <?php 
            include '../NavBar_Footer/nav.php';
        ?>
        <div class ="container">
            <h2>Leave a review!</h2>
        </div>
        <div class ="container">
            <h2><?php echo $row['name']?></h2>
            <h3><?php echo $row['price']?></h3>
        </div>
        <!--<p><?php echo $pid?></p>-->            
        <!--<p><?php echo $uid?></p>-->
        <main id ="mainform">
            <form method="POST" id="mainform">
                <label>Rating:</label>
                <input type="text" name="rating" id="rating" required>
                <br/><br/>
                <textarea rows="7" cols="55" name="comment" id="comment"></textarea>
                <br/><br/>
                <button type="submit" class="button" name="submit">Submit Review</button>
            </form>
        </main>
    </body>
</html>