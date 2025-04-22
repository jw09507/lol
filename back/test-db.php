<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';

if ($conn->ping()) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed: " . $conn->connect_error;
}
?>