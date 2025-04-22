<?php
error_reporting(0); // Disable error reporting
ini_set('display_errors', 0); // Do not display errors
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if it hasn't been started already
}
require_once '../back/redirect-logged-in.php'; // Ensure the path is correct
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <nav>
    <div class="brand"><a href="index.php">Rolsa Technologies</a></div>
    <div class="nav-links">
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>
  </nav>
  <h1>Login</h1>
  <form action="../back/login-handler.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
  </form>
</body>
</html>