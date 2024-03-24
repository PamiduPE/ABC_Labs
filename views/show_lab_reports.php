<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}


require_once('../includes/db_connection.php');


$user_id = $_SESSION['user_id'];


$sql_lab_reports = "SELECT * FROM lab_report WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql_lab_reports);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result_lab_reports = mysqli_stmt_get_result($stmt);


mysqli_stmt_close($stmt);


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lab Reports</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navigation.css">
</head>

<body>
<div class="wrapper">
    <div class="sidebar">
        <h2>ABC Labs</h2>
       
        <ul>
            <li><a href="patient_dashboard.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="show_lab_reports.php"><i class="fas fa-user"></i>My reports</a></li>
            <li><a href="aboutus.php"><i class="fas fa-address-card"></i>About</a></li>
        
        </ul> 
        <div class="social_media">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="main_content">
        <div class="header">Welcome!! Have a nice day.</div>  
        </div>
</div>
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
