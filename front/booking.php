<?php
session_start();
$error_message = $_SESSION['error_message'] ?? null;
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['error_message'], $_SESSION['form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking - Carbon Footprint Tracker</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .forms-container {
      display: flex;
      justify-content: space-between;
      align-items: stretch;
      gap: 20px; /* Reduced gap to save horizontal space */
      max-width: 100%; /* Ensure the container fits within the viewport */
      margin: 20px auto;
      height: auto; /* Allow the forms to adjust their height dynamically */
      flex-wrap: nowrap; /* Prevent forms from stacking vertically on larger screens */
    }

    .booking-form {
      flex: 1; /* Ensure both forms take up equal space */
      padding: 15px; /* Reduced padding to save space */
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-sizing: border-box;
      min-width: 300px; /* Prevent forms from shrinking too much */
      max-width: 48%; /* Ensure forms fit side by side */
    }

    /* Responsive Design for Mobile Screens */
    @media (max-width: 768px) {
      .forms-container {
        flex-direction: column; /* Stack forms vertically */
        max-width: 90%; /* Reduce the width for smaller screens */
        margin: 20px auto; /* Center the forms */
      }

      .booking-form {
        max-width: 100%; /* Allow forms to take full width */
        margin-bottom: 20px; /* Add spacing between stacked forms */
      }
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
  <h1>Booking</h1>
  <?php if ($error_message): ?>
    <p style="color: red; text-align: center;"><?php echo htmlspecialchars($error_message); ?></p>
  <?php endif; ?>

  <div class="forms-container">
    <!-- Booking Forms -->
    <form action="../back/consultation-booking.php" method="POST" class="booking-form">
      <h2>Book a Consultation</h2>
      <label for="consultation-product">Product:</label>
      <select id="consultation-product" name="product" required>
        <option value="solar-panels">Solar Panels</option>
        <option value="ev-charging-stations">Electric Vehicle Charging Stations</option>
        <option value="smart-home-energy-systems">Smart Home Energy Systems</option>
      </select>
      <label for="consultation-name">Full Name:</label>
      <input type="text" id="consultation-name" name="full_name" required>
      <label for="consultation-address">Address:</label>
      <input type="text" id="consultation-address" name="address" required>
      <label for="consultation-postal-code">Postal Code:</label>
      <input type="text" id="consultation-postal-code" name="postal_code" required>
      <button type="submit">Book Consultation</button>
    </form>

    <form action="../back/installation-booking.php" method="POST" class="booking-form">
      <h2>Book an Installation</h2>
      <label for="installation-product">Product:</label>
      <select id="installation-product" name="product" required>
        <option value="solar-panels">Solar Panels</option>
        <option value="ev-charging-stations">Electric Vehicle Charging Stations</option>
        <option value="smart-home-energy-systems">Smart Home Energy Systems</option>
      </select>
      <label for="installation-name">Full Name:</label>
      <input type="text" id="installation-name" name="full_name" required>
      <label for="installation-address">Address:</label>
      <input type="text" id="installation-address" name="address" required>
      <label for="installation-postal-code">Postal Code:</label>
      <input type="text" id="installation-postal-code" name="postal_code" required>
      <button type="submit">Book Installation</button>
    </form>
  </div>
</body>
</html>