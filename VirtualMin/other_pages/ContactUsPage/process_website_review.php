<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get review data
    $review = $_POST["review"];

    $to = "200143671@aston.ac.uk";
    $subject = "Website review Submission";
    $headers = "From: $email";
    $body = "Name: $name\n\nEmail: $email\n\nMessage:\n$message";

    // Send the email
    mail($to, $subject, $body, $headers);

    // Redirect back to the contact page or any other appropriate page
    header("Location: contactus.php");
    exit();
} else {
    // Redirect back to the contact page
    header("Location: contactus.php");
    exit();
}
?>