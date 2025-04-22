<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect all logged-in users to the profile page
    header("Location: profile.php");
    exit;
}
?>