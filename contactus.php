<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .contact-form {
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<?php include 'nav.php'; ?>

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