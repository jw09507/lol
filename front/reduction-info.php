<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reduction Info - Carbon Footprint Tracker</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .forms-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr); /* 2x2 grid layout */
      grid-row-gap: 45px; /* Vertical gap between rows */
      grid-column-gap: 50px; /* Horizontal gap between columns */
      max-width: 90%; /* Adjust the container width */
      margin: 20px auto; /* Center the container */
      align-items: stretch; /* Stretch forms to fit their content */
    }

    .tip-form {
      display: flex;
      flex-direction: row; /* Arrange text and image side by side */
      align-items: center;
      justify-content: space-between;
      padding: 20px;
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%; /* Allow the form to take full width of its grid cell */
      box-sizing: border-box;
    }

    .tip-text {
      flex: 2; /* Allocate more space for text */
      padding-right: 10px;
    }

    .tip-text h3 {
      font-size: 1.5em; /* Larger subheading */
      margin-bottom: 10px;
      color: var(--primary-color);
    }

    .tip-text p {
      font-size: 1em; /* Smaller description */
      color: var(--text-color);
    }

    .tip-image {
      flex: 1; /* Allocate space for the image */
      text-align: center;
    }

    .tip-image img {
      width: auto; /* Allow the image to scale dynamically */
      height: auto; /* Allow the image to scale dynamically */
      max-width: 300%; /* Set the maximum width to 300% */
      border-radius: 5px;
    }
  </style>
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
  <h1>Reduction Info</h1>

  <div class="forms-container">
    <!-- Tip 1 -->
    <form class="tip-form">
        <div class="tip-text">
            <h3>Switch to Renewable Energy</h3>
            <p>Install solar panels or wind turbines to generate clean energy for your home.</p>
        </div>
        <div class="tip-image">
            <img src="https://images.pexels.com/photos/414943/pexels-photo-414943.jpeg" alt="Solar Panel Icon">
        </div>
    </form>

    <!-- Tip 2 -->
    <form class="tip-form">
        <div class="tip-text">
            <h3>Use Public Transport</h3>
            <p>Reduce your carbon footprint by using buses, trains, or carpooling instead of driving alone.</p>
        </div>
        <div class="tip-image">
            <img src="https://images.pexels.com/photos/3480390/pexels-photo-3480390.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Public Transport Icon">
        </div>
    </form>

    <!-- Tip 3 -->
    <form class="tip-form">
        <div class="tip-text">
            <h3>Adopt Energy-Efficient Appliances</h3>
            <p>Replace old appliances with energy-efficient models to save energy and reduce emissions.</p>
        </div>
        <div class="tip-image">
            <img src="https://images.pexels.com/photos/7111156/pexels-photo-7111156.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Appliances Icon">
        </div>
    </form>

    <!-- Tip 4 -->
    <form class="tip-form">
        <div class="tip-text">
            <h3>Reduce, Reuse, Recycle</h3>
            <p>Minimize waste by recycling and reusing materials whenever possible.</p>
        </div>
        <div class="tip-image">
            <img src="https://images.pexels.com/photos/9324320/pexels-photo-9324320.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Recycle Icon">
        </div>
    </form>
</div>
</body>
</html>