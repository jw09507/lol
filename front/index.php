<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="styles.css"> <!-- Corrected path for styles.css -->
  <style>
    :root {
      --footer-color: #6D6B4A; /* Footer color */
      --footer-thickness: 50px; /* Customizable footer thickness */
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Itim', cursive;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #F0F1ED; /* Restore the original background color */
    }

    .page-content {
      flex: 1; /* Ensures the content takes up available space */
      display: flex;
      flex-direction: column;
      justify-content: flex-start; /* Align content to the top */
      align-items: center;
      margin-top: 120px; /* Add margin to align with other pages */
    }
  </style>
</head>
<body>
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
  <div class="page-content">
    <h1>Welcome to Rolsa Technologies!</h1>
    <div class="button-container">
      <form class="button-box-left" action="reduction-info.php">
        <p>Learn how to reduce your carbon footprint:</p>
        <button type="submit">Reduction Info</button>
      </form>
      <form class="button-box-right" action="carbon-calculator.php">
        <p>Calculate your carbon footprint:</p>
        <button type="submit">Carbon Calculator</button>
      </form>
    </div>
  </div>
</body>
</html>