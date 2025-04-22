<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Successful</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="page-content">
  <nav>
    <div class="brand"><a href="index.php">Rolsa Technologies</a></div>
    <div class="nav-links">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="../back/profile.php">Profile</a>
        <a href="booking.php">Booking</a>
        <a href="../back/logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
      <?php endif; ?>
    </div>
  </nav>
  <h1>Login Successful</h1>
  <p>Welcome back! Your login was successful.</p>
  <div class="buttons">
  <button onclick="location.href='../back/profile.php'">Go to Profile</button>
  </div>
</body>
</html>