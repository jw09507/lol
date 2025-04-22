<?php
session_start();
require_once 'db.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists in the `users` database
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    if (!$stmt) {
        error_log("Prepare failed (username check): " . $conn->error); // Log the error
        die("An error occurred while preparing the SQL statement. Please try again later.");
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username already exists, redirect back to the register page with an error
        header("Location: ../front/register.php?error=username_taken");
        exit;
    }

    // Insert the new user into the `users` database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        error_log("Prepare failed (user insertion): " . $conn->error); // Log the error
        die("An error occurred while preparing the SQL statement. Please try again later.");
    }
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Set session variables for the new user
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;

        // Redirect to the profile page
        header("Location: profile.php");
        exit;

    } else {
        // Log the error and redirect back to the register page
        error_log("Execute failed: " . $stmt->error);
        header("Location: ../front/register.php?error=registration_failed");
        exit;
    }
} else {
    // If the request method is not POST, redirect to the register page
    header("Location: ../front/register.php");
    exit;
}
?>