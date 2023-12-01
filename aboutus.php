<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        /* CSS styles here, gonna change em later */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .contact-form {
            display: none;
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<div>
    <h1>About Us</h1>
    <p>
        Welcome to Treakers!I need to think of something to put in this goofy ahh section
    </p>
    <p>
        Second paragraph for extra info. webdev isnt fun
    </p>
    <button onclick="toggleContactForm()">Contact Us</button>
</div>

<div class="contact-form" id="contactForm">
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

<script>
    function toggleContactForm() {
        var contactForm = document.getElementById('contactForm');
        contactForm.style.display = (contactForm.style.display === 'none' || contactForm.style.display === '') ? 'block' : 'none';
    }
</script>

</body>
</html>

