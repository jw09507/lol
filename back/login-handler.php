<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if the username exists in the `users` database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    if (!$stmt) {
        error_log("Prepare failed (login check): " . $conn->error); // Log the error
        die("An error occurred while preparing the SQL statement. Please try again later.");
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the profile page
            header("Location: profile.php");
            exit;
        }
    }

    // If login fails, redirect back to the login page with an error
    $_SESSION['error'] = "Invalid username or password.";
    header("Location: ../front/login.php");
    exit;
}
?>