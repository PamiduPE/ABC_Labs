<?php
// Include database connection
require_once '../includes/db_connection.php';

// Query to retrieve all users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    // Display user data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Error: Unable to fetch users.";
}

// Close database connection
mysqli_close($conn);
?>
