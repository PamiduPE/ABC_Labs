<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Include database connection
require_once('../includes/db_connection.php');

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Get appointment details from form submission
$date = $_POST['date'];
$time = $_POST['time'];
$test_type = $_POST['test_type'];

// Insert appointment into the database
$sql = "INSERT INTO appointments (patient_id, date, time, test_type) VALUES ('$user_id', '$date', '$time', '$test_type')";

if (mysqli_query($conn, $sql)) {
    // Appointment added successfully
    header("Location: patient_dashboard.php");
    exit;
} else {
    // Error adding appointment
    echo "Error: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
