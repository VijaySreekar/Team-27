<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Compose the email content
    $to = "200143671@aston.ac.uk";
    $subject = "Contact Form Submission";
    $headers = "From: $email";
    $body = "Name: $name\n\nEmail: $email\n\nMessage:\n$message";

    // Send the email
    mail($to, $subject, $body, $headers);

    // Redirect back to the contact page
    header("Location: contactus.php");
    exit();
}
?>