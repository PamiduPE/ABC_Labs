<?php
require_once('../includes/db_connection.php');
require_once('../includes/functions.php');

// Function to retrieve all doctor users
function getAllDoctorUsers() {
    global $conn;
    $sql = "SELECT * FROM doctor_users";
    $result = mysqli_query($conn, $sql);
    $doctorUsers = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctorUsers[] = $row;
        }
    }
    return $doctorUsers;
}

// Function to add a new doctor user
function addDoctorUser($name, $email, $password) {
    global $conn;
    // Sanitize inputs
    $name = sanitize_input($name);
    $email = sanitize_input($email);
    $password = sanitize_input($password);
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Insert user data into database
    $sql = "INSERT INTO doctor_users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a doctor user
function deleteDoctorUser($userId) {
    global $conn;
    // Sanitize input
    $userId = sanitize_input($userId);
    // Delete user from database
    $sql = "DELETE FROM doctor_users WHERE id = '$userId'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Example usage:
// $doctorUsers = getAllDoctorUsers();
// $result = addDoctorUser('Dr. John Doe', 'john@example.com', 'password123');
// $result = deleteDoctorUser(1);
?>
