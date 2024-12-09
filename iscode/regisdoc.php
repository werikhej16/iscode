<?php
// register.php

// Include the database configuration file
require 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $licenseId = trim($_POST['licenseId']);
    
    // Validate inputs
    $errors = [];

    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Validate license ID (example: must not be empty)
    if (empty($licenseId)) {
        $errors[] = "License ID is required.";
    }

    // Check for errors before proceeding
    if (empty($errors)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO doctor (name, email, password, licenseId) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $passwordHash, $licenseId);

        // Hash the password for security
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or display success message
            echo "New record created successfully";
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

// Close the database connection
$conn->close();
?>