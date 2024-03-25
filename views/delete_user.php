<?php
// Check if user ID is provided
if(isset($_POST['user_id'])) {
    // Include database connection
    require_once '../includes/db_connection.php';

    // Sanitize user ID to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // SQL query to delete user from the database
    $sql = "DELETE FROM users WHERE id = '$user_id'";

    // Execute the query
    if(mysqli_query($conn, $sql)) {
        // User deleted successfully
        echo "User deleted successfully.";
    } else {
        // Error occurred while deleting user
        echo "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // User ID not provided
    echo "Error: User ID not provided.";
}
?>
