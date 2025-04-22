<?php
session_start();
$answers = json_decode($_POST['carbonAnswers'] ?? '{}', true);

// Example calculation logic (replace with WWF guidelines)
$totalCarbonFootprint = 0;
$totalCarbonFootprint += ($answers['car_km'] ?? 0) * 0.2; // Example: 0.2 kg CO2 per km
$totalCarbonFootprint += ($answers['public_transport_km'] ?? 0) * 0.1; // Example: 0.1 kg CO2 per km
$totalCarbonFootprint += ($answers['electricity_kwh'] ?? 0) * 0.5; // Example: 0.5 kg CO2 per kWh
$totalCarbonFootprint += ($answers['gas_liters'] ?? 0) * 2.3; // Example: 2.3 kg CO2 per liter
$totalCarbonFootprint += ($answers['meat_meals'] ?? 0) * 3; // Example: 3 kg CO2 per meal
$totalCarbonFootprint += ($answers['dairy_meals'] ?? 0) * 1.5; // Example: 1.5 kg CO2 per meal
$totalCarbonFootprint += ($answers['short_flights'] ?? 0) * 250; // Example: 250 kg CO2 per flight
$totalCarbonFootprint += ($answers['long_flights'] ?? 0) * 1000; // Example: 1000 kg CO2 per flight
$totalCarbonFootprint += ($answers['waste_kg'] ?? 0) * 52; // Example: 52 kg CO2 per kg of waste per year
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carbon Footprint Results</title>
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
  <h1>Carbon Footprint Results</h1>
  <div class="profile-container">
    <form class="profile-form">
      <p>Your total carbon footprint is approximately:</p>
      <h2><strong><?php echo number_format($totalCarbonFootprint, 2); ?> kg CO2</strong> per year.</h2>
      <div style="text-align: center; margin-top: 20px;">
        <a href="carbon-calculator.php" class="button">Retake the Calculator</a>
      </div>
    </form>
  </div>
</body>
</html>