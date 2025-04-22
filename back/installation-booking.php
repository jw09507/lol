<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    error_log("User not logged in. Redirecting to login page.");
    header("Location: ../front/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Validate input
    $product = $_POST['product'];
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];

    $error_message = null;

    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $address)) {
        $error_message = "Invalid address format. Please enter a valid address.";
    }

    if (!preg_match("/^[a-zA-Z0-9\s\-]+$/", $postal_code)) {
        $error_message = "Invalid postal code format. Please enter a valid postal code.";
    }

    // If there are validation errors, redirect back to the booking page with the error message
    if ($error_message) {
        $_SESSION['error_message'] = $error_message;
        $_SESSION['form_data'] = $_POST; // Save the form data so the user doesn't have to retype it
        header("Location: ../front/booking.php");
        exit;
    }

    // Check if the user already has a booking
    $stmt = $conn->prepare("SELECT id FROM bookings WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error_message'] = "You already have a booking. You cannot book another product.";
        $_SESSION['form_data'] = $_POST;
        header("Location: ../front/booking.php");
        exit;
    }

    // Proceed with booking
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, type, product, full_name, address, postal_code) VALUES (?, 'installation', ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $product, $full_name, $address, $postal_code);

    if ($stmt->execute()) {
        error_log("Booking successfully inserted into the database for user ID: $user_id");
        header("Location: ../back/profile.php?success=installation_booked");
        exit;
    } else {
        error_log("Database error: " . $stmt->error);
        die("An error occurred while processing your booking. Please try again later.");
    }
}
?>