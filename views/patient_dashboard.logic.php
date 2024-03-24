<?php
session_start();
require_once('../includes/db_connection.php');

$error_message = "";
$profile_picture = ""; // Define the variable

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Fetch user info including the profile picture path
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);

        // Check if the user is a patient
        if ($user_info['user_type'] === 'patient') {
            // Fetch appointments
            $sql = "SELECT * FROM appointments WHERE patient_id = $user_id";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
            } else {
                $error_message = "No appointments scheduled.";
            }

            // Fetch lab reports
            $sql = "SELECT * FROM lab_report WHERE user_id = $user_id";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $lab_reports = mysqli_fetch_all($result, MYSQLI_ASSOC);
            } else {
                $error_message = "No lab reports available.";
            }

            // Fetch billing information
            $sql = "SELECT * FROM billing WHERE patient_id = $user_id";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $billing_info = mysqli_fetch_assoc($result);
            } else {
                $error_message = "No billing information available.";
            }
            
            // Fetch the profile picture path
            $profile_picture = "../" . $user_info['profile_picture'];  // Assign the variable
        } else {
            // Redirect to respective dashboards for non-patient users
            if ($user_info['user_type'] === 'doctor') {
                header("Location: doctor_dashboard.php");
                exit;
            } elseif ($user_info['user_type'] === 'technician') {
                header("Location: technician_dashboard.php");
                exit;
            }
        }
    } else {
        $error_message = "User not found.";
    }
} else {
    // Redirect to login page if user is not logged in
    header("Location: ../login.php");
    exit;
}

mysqli_close($conn);
?>
