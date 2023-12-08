<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="custom-styles.css">
</head>

<body>

<?php include("Nav Bar\\nav.php"); ?>

<div class="contact-form">
    <h2>Contact Us</h2>
    <form action="process_contact_form.php" method="post">
        <label for="name">Your Name:</label>
        <input type="text" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" name="email" required>

        <label for="message">Message:</label>
        <textarea name="message" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>