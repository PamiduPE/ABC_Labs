<?php
require_once ('../includes/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Check if appointment ID is set and numeric
    if (isset($_POST['appointment_id']) && is_numeric($_POST['appointment_id'])) {
        // Get appointment ID
        $appointment_id = $_POST['appointment_id'];

        // Perform the deletion operation (Implement as per your database structure)
        // Example SQL query: DELETE FROM appointments WHERE id = $appointment_id;
        // Execute the query using mysqli_query or PDO

        // Redirect back to the patient dashboard page
        header("Location: patient_dashboard.php");
        exit();
    } else {
        // Handle invalid appointment ID
        // Redirect back to the patient dashboard page or show an error message
        header("Location: patient_dashboard.php?error=invalid_appointment_id");
        exit();
    }
} else {
    // Handle unauthorized access or invalid request method
    // Redirect back to the patient dashboard page or show an error message
    header("Location: patient_dashboard.php?error=unauthorized_access");
    exit();
}
?>
