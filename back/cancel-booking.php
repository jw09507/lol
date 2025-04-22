<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../front/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("DELETE FROM bookings WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header("Location: ../back/profile.php?success=booking_canceled");
        exit;
    } else {
        error_log("Database error: " . $stmt->error);
        header("Location: ../back/profile.php?error=cancel_failed");
        exit;
    }
}
?>