<?php
require_once('../includes/db_connection.php');
require_once('../includes/functions.php');

// Function to retrieve all technician users
function getAllTechnicianUsers() {
    global $conn;
    $sql = "SELECT * FROM technician_users";
    $result = mysqli_query($conn, $sql);
    $technicianUsers = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $technicianUsers[] = $row;
        }
    }
    return $technicianUsers;
}

// Function to add a new technician user
function addTechnicianUser($name, $email, $password) {
    global $conn;
    // Sanitize inputs
    $name = sanitize_input($name);
    $email = sanitize_input($email);
    $password = sanitize_input($password);
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Insert user data into database
    $sql = "INSERT INTO technician_users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a technician user
function deleteTechnicianUser($userId) {
    global $conn;
    // Sanitize input
    $userId = sanitize_input($userId);
    // Delete user from database
    $sql = "DELETE FROM technician_users WHERE id = '$userId'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Example usage:
// $technicianUsers = getAllTechnicianUsers();
// $result = addTechnicianUser('Technician John', 'john@example.com', 'password123');
// $result = deleteTechnicianUser(1);
?>
