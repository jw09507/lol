<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carbon Footprint Calculator</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .progress-bar-container {
      display: flex;
      justify-content: center; /* Center the progress bar horizontally */
      margin-bottom: 20px;
    }

    .progress-bar {
      width: 48%; /* Set the width of the progress bar */
      background-color: #ccc;
      border-radius: 5px;
      overflow: hidden;
      position: relative;
    }

    .progress-bar-fill {
      height: 20px;
      background-color: var(--primary-color);
      width: 0;
      transition: width 0.3s ease;
    }

    .progress-percentage {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      font-weight: bold;
      color: white;
    }

    .calculator-form {
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

    .question-container {
      margin-bottom: 20px;
    }

    .navigation-buttons {
      display: flex;
      justify-content: space-between;
      gap: 10px; /* Add gap between buttons */
      margin-top: 20px;
    }

    .navigation-buttons button {
      padding: 8px 15px; /* Smaller buttons */
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease; /* Smooth transition for hover effect */
    }

    .navigation-buttons button:hover {
      background-color: var(--primary-hover-color); /* Apply hover color */
    }

    .navigation-buttons button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
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
  <h1>Carbon Footprint Calculator</h1>

  <div class="progress-bar-container">
    <div class="progress-bar">
      <div class="progress-bar-fill" id="progress-bar-fill"></div>
      <div class="progress-percentage" id="progress-percentage">0%</div>
    </div>
  </div>

  <form class="calculator-form" id="calculator-form" onsubmit="handleSubmit(event)">
    <div class="question-container">
      <h2 id="question-title">Question 1</h2>
      <p id="question-text">How many kilometers do you travel by car each week?</p>
      <input type="number" id="question-input" placeholder="Enter your answer" required>
    </div>

    <div class="navigation-buttons">
      <button type="button" id="prev-button" onclick="prevQuestion()" disabled>&larr; Previous</button>
      <button type="submit" id="next-button">Next &rarr;</button>
    </div>
  </form>

  <script>
    const questions = [
      { text: "How many kilometers do you travel by car each week?", key: "car_km" },
      { text: "How many kilometers do you travel by public transport each week?", key: "public_transport_km" },
      { text: "How much electricity (in kWh) do you use each month?", key: "electricity_kwh" },
      { text: "How much gas (in liters) do you use each month?", key: "gas_liters" },
      { text: "How often do you eat meat each week?", key: "meat_meals" },
      { text: "How often do you eat dairy products each week?", key: "dairy_meals" },
      { text: "How many flights (short-haul) do you take each year?", key: "short_flights" },
      { text: "How many flights (long-haul) do you take each year?", key: "long_flights" },
      { text: "How much waste do you produce each week (in kg)?", key: "waste_kg" },
    ];

    let currentQuestionIndex = 0;
    const answers = {};

    function updateQuestion() {
      const questionTitle = document.getElementById("question-title");
      const questionText = document.getElementById("question-text");
      const questionInput = document.getElementById("question-input");
      const progressBarFill = document.getElementById("progress-bar-fill");
      const progressPercentage = document.getElementById("progress-percentage");

      // Update question text
      questionTitle.textContent = `Question ${currentQuestionIndex + 1}`;
      questionText.textContent = questions[currentQuestionIndex].text;

      // Restore previous answer if available
      const currentKey = questions[currentQuestionIndex].key;
      questionInput.value = answers[currentKey] || "";

      // Update progress bar
      const progress = (currentQuestionIndex / questions.length) * 100;
      progressBarFill.style.width = `${progress}%`;
      progressPercentage.textContent = `${Math.round(progress)}%`;

      // Enable/disable navigation buttons
      document.getElementById("prev-button").disabled = currentQuestionIndex === 0;
      document.getElementById("next-button").textContent =
        currentQuestionIndex === questions.length - 1 ? "Submit" : "Next →";
    }

    function nextQuestion() {
      const questionInput = document.getElementById("question-input");
      const currentKey = questions[currentQuestionIndex].key;

      // Save the current answer
      answers[currentKey] = questionInput.value;

      // Move to the next question
      if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        updateQuestion();
      } else {
        // Redirect to results page
        localStorage.setItem("carbonAnswers", JSON.stringify(answers));
        window.location.href = "carbon-results.php";
      }
    }

    function prevQuestion() {
      const questionInput = document.getElementById("question-input");
      const currentKey = questions[currentQuestionIndex].key;

      // Save the current answer
      answers[currentKey] = questionInput.value;

      // Move to the previous question
      if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        updateQuestion();
      }
    }

    function handleSubmit(event) {
      event.preventDefault();
      nextQuestion();
    }

    // Initialize the first question
    updateQuestion();
  </script>
</body>
</html>