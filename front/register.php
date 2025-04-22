<?php
error_reporting(0); // Disable error reporting
ini_set('display_errors', 0); // Do not display errors
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if it hasn't been started already
}
require_once '../back/redirect-logged-in.php'; // Ensure the path is correct

// Get the error message from the query string
$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .error-box {
      color: var(--error-color);
      background-color: #ffe6e6;
      border: 1px solid var(--error-color);
      padding: 10px;
      margin-bottom: 20px;
      text-align: center;
      border-radius: 5px;
    }
  </style>
  <script>
    // JavaScript validation to ensure the form prevents invalid submissions
    function validateForm(event) {
      const username = document.getElementById("username");
      const email = document.getElementById("email");
      const password = document.getElementById("password");

      // Username validation
      const usernamePattern = /^[a-zA-Z0-9_]{3,20}$/;
      if (!usernamePattern.test(username.value)) {
        alert("Username must be 3-20 characters long and can only contain letters, numbers, and underscores.");
        event.preventDefault();
        return false;
      }

      // Email validation
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!emailPattern.test(email.value)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return false;
      }

      // Password validation
      const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      if (!passwordPattern.test(password.value)) {
        alert("Password must be at least 8 characters long and include at least one letter and one number.");
        event.preventDefault();
        return false;
      }

      return true; // Allow form submission if all validations pass
    }
  </script>
</head>
<body>
  <nav>
    <div class="brand"><a href="index.php">Rolsa Technologies</a></div>
    <div class="nav-links">
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>
  </nav>
  <h1>Register</h1>
  <form action="../back/register-handler.php" method="POST" onsubmit="return validateForm(event)">
    <?php if ($error): ?>
      <div class="error-box">
        <?php
        switch ($error) {
          case 'invalid_username':
            echo "Username must be 3-20 characters long and can only contain letters, numbers, and underscores.";
            break;
          case 'invalid_email':
            echo "Please enter a valid email address.";
            break;
          case 'invalid_password':
            echo "Password must be at least 8 characters long and include at least one letter and one number.";
            break;
          case 'username_taken':
            echo "The username is already taken. Please choose another one.";
            break;
          case 'registration_failed':
            echo "An error occurred during registration. Please try again later.";
            break;
          default:
            echo "An unknown error occurred. Please try again.";
        }
        ?>
      </div>
    <?php endif; ?>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required pattern="^[a-zA-Z0-9_]{3,20}$" title="Username must be 3-20 characters long and can only contain letters, numbers, and underscores.">
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address.">
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must be at least 8 characters long and include at least one letter and one number.">
    
    <button type="submit">Register</button>
  </form>
</body>
</html>