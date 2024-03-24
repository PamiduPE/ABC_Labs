<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Include database connection
require_once('../includes/db_connection.php');

// Get user ID of the logged-in user
$user_id = $_SESSION['user_id'];

// Fetch lab reports associated with the logged-in user
$sql_lab_reports = "SELECT * FROM lab_report WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql_lab_reports);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result_lab_reports = mysqli_stmt_get_result($stmt);

// Close statement
mysqli_stmt_close($stmt);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lab Reports</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="../logout.php">Logout</a></li> <!-- Add a logout link -->
        </ul>
    </nav>
    <div class="container">
        <h1>Lab Reports</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Test Type</th>
                    <th>Report File</th>
                    <th>Doctor Response</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_lab_reports)) : ?>
                    <tr>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['test_type']; ?></td>
                        <td>
        <?php 
            $report_file = $row['report_file'];
            if (!empty($report_file)) {
                echo '<a href="../uploads/' . $report_file . '" download="' . $report_file . '">Download Report</a>';
            } else {
                echo 'No report available';
            }
        ?>
    </td>
                        <td><?php echo $row['doctor_response']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
