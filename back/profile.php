<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../front/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch bookings
$stmt = $conn->prepare("SELECT type, product, full_name, address, postal_code, created_at FROM bookings WHERE user_id = ?");
if (!$stmt) {
    error_log("Prepare failed for bookings query: " . $conn->error); // Log the error
    die("An error occurred while fetching bookings. Please try again later.");
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);

// Fetch carbon footprint results
$carbon_results = [];
$carbon_stmt = $conn->prepare("SELECT id, result, created_at FROM carbon_footprint_results WHERE user_id = ? ORDER BY created_at DESC");
if ($carbon_stmt) {
    $carbon_stmt->bind_param("i", $user_id);
    $carbon_stmt->execute();
    $carbon_results = $carbon_stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    error_log("Prepare failed for carbon footprint query: " . $conn->error); // Log the error
    // Do not stop the page; just leave $carbon_results empty
}

$error = $_GET['error'] ?? null;
$success = $_GET['success'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Carbon Footprint Tracker</title>
  <link rel="stylesheet" href="../front/styles.css">
  <style>
    .profile-container {
      display: flex;
      justify-content: space-between;
      align-items: stretch;
      gap: 20px;
      max-width: 100%;
      margin: 20px auto;
      height: auto;
      flex-wrap: wrap;
    }
    .profile-form {
      flex: 1;
      padding: 15px;
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-sizing: border-box;
      min-width: 300px;
      max-width: 48%;
    }

    .profile-form h2 {
      text-align: center;
      margin-bottom: 20px;
      color: var(--text-color);
    }

    .booking-details, .carbon-details {
      margin-bottom: 20px;
      padding: 10px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .booking-details p, .carbon-details p {
      margin: 5px 0;
      color: var(--text-color);
    }

    .no-bookings, .no-results {
      text-align: center;
      color: var(--text-color);
      margin-top: 20px;
    }

    .profile-form button {
      display: block;
      margin: 20px auto 0;
      padding: 10px 20px;
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .profile-form button:hover {
      background-color: var(--primary-hover-color);
    }

    .compare-results {
      margin-top: 20px;
    }
  </style>
</head>
<body class="page-content">
  <nav>
    <div class="brand"><a href="../front/index.php">Rolsa Technologies</a></div>
    <div class="nav-links">
      <a href="profile.php">Profile</a>
      <a href="../front/booking.php">Booking</a>
      <a href="logout.php">Logout</a>
    </div>
  </nav>
  <h1>Profile</h1>
  <div class="profile-container">
    <!-- Booking Form -->
    <form class="profile-form" action="../back/cancel-booking.php" method="POST">
      <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
      <?php if (!empty($bookings)): ?>
        <h3>Your Bookings:</h3>
        <?php foreach ($bookings as $booking): ?>
          <div class="booking-details">
            <p><strong>Type:</strong> <?php echo htmlspecialchars(ucwords(strtolower($booking['type']))); ?></p>
            <p><strong>Product:</strong> <?php echo htmlspecialchars(ucwords(strtolower($booking['product']))); ?></p>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars(ucwords(strtolower($booking['full_name']))); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars(ucwords(strtolower($booking['address']))); ?></p>
            <p><strong>Postal Code:</strong> <?php echo htmlspecialchars(strtoupper($booking['postal_code'])); ?></p>
            <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking['created_at']); ?></p>
          </div>
        <?php endforeach; ?>
        <button type="submit">Cancel All Bookings</button>
      <?php else: ?>
        <p class="no-bookings">You have no bookings yet.</p>
        <a href="../front/booking.php" class="profile-form-button">Make a Booking</a>
      <?php endif; ?>
    </form>

    <!-- Carbon Footprint Results Form -->
    <form class="profile-form">
      <h2>Your Carbon Footprint</h2>
      <?php if (!empty($carbon_results)): ?>
        <div class="carbon-details">
          <p><strong>Most Recent Result:</strong> <?php echo htmlspecialchars($carbon_results[0]['result']); ?> kg CO2</p>
          <p><strong>Date:</strong> <?php echo htmlspecialchars($carbon_results[0]['created_at']); ?></p>
        </div>
        <div class="compare-results">
          <label for="past-results">Compare with Past Results:</label>
          <select id="past-results" name="past-results">
            <?php foreach ($carbon_results as $result): ?>
              <option value="<?php echo htmlspecialchars($result['id']); ?>">
                <?php echo htmlspecialchars($result['created_at']); ?> - <?php echo htmlspecialchars($result['result']); ?> kg CO2
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      <?php else: ?>
        <p class="no-results">You haven't completed the carbon calculator yet.</p>
        <a href="../front/carbon-calculator.php" class="profile-form-button">Take the Carbon Calculator</a>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>