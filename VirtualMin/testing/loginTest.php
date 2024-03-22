<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testSuccessfulLogin()
    {
        // Mock POST request parameters
        $_POST["login_email"] = "test@example.com";
        $_POST["login_password"] = "password";

        // Include the file containing the login code
        $output = include_once __DIR__ . '/../other_pages/LoginPage/VerifyUser.php';

        // Decode the JSON response
        $decoded_output = json_decode($output, true);

        // Check if decoding was successful
        $this->assertNotNull($decoded_output);

        // Check if login was successful
        $this->assertTrue($decoded_output['success']);
    }

    public function testIncorrectPassword()
    {
        // Mock POST request parameters
        $_POST["login_email"] = "test@example.com";
        $_POST["login_password"] = "wrongpassword";

        // Include the file containing the login code
        $output = include_once __DIR__ . '/../other_pages/LoginPage/VerifyUser.php';

        // Decode the JSON response
        $decoded_output = json_decode($output, true);

        // Check if decoding was successful
        $this->assertNotNull($decoded_output);

        // Check if login failed due to incorrect password
        $this->assertFalse($decoded_output['success']);
        $this->assertEquals("Incorrect password. Please try again.", $decoded_output['message']);
    }

    public function testUserNotFound()
    {
        // Mock POST request parameters
        $_POST["login_email"] = "nonexistent@example.com";
        $_POST["login_password"] = "password";

        // Include the file containing the login code
        $output = include_once __DIR__ . '/../other_pages/LoginPage/VerifyUser.php';

        // Decode the JSON response
        $decoded_output = json_decode($output, true);

        // Check if decoding was successful
        $this->assertNotNull($decoded_output);

        // Check if login failed due to user not found
        $this->assertFalse($decoded_output['success']);
        $this->assertEquals("User not found. Please check your email.", $decoded_output['message']);
    }
}
