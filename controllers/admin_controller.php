<?php
require_once('../includes/db_connection.php');
require_once('../includes/functions.php');

// Function to retrieve all admin users
function getAllAdminUsers() {
    global $conn;
    $sql = "SELECT * FROM admin_users";
    $result = mysqli_query($conn, $sql);
    $adminUsers = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $adminUsers[] = $row;
        }
    }
    return $adminUsers;
}

// Function to add a new admin user
function addAdminUser($name, $email, $password) {
    global $conn;
    // Sanitize inputs
    $name = sanitize_input($name);
    $email = sanitize_input($email);
    $password = sanitize_input($password);
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Insert user data into database
    $sql = "INSERT INTO admin_users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Function to delete an admin user
function deleteAdminUser($userId) {
    global $conn;
    // Sanitize input
    $userId = sanitize_input($userId);
    // Delete user from database
    $sql = "DELETE FROM admin_users WHERE id = '$userId'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Example usage:
// $adminUsers = getAllAdminUsers();
// $result = addAdminUser('John Doe', 'john@example.com', 'password123');
// $result = deleteAdminUser(1);
?>
