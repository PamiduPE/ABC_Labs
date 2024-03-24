<?php
session_start();




if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'doctor') {
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


// Check for form submission and update response if needed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $reportId = $_POST['report_id'];
  $updatedResponse = $_POST['doctor_response'];

  // Connect to database (assuming connection details in db_connection.php)
  require_once('../includes/db_connection.php');

  // Update response in database
  $updateQuery = "UPDATE lab_report SET doctor_response = ? WHERE id = ?";
  $stmt = mysqli_prepare($conn, $updateQuery);
  mysqli_stmt_bind_param($stmt, "si", $updatedResponse, $reportId);
  mysqli_stmt_execute($stmt);

  // Re-fetch updated data (you might optimize this later)
  $sql_lab_reports = "SELECT * FROM lab_report WHERE user_id = ?";
  $stmt = mysqli_prepare($conn, $sql_lab_reports);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  $result_lab_reports = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);

  mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Lab Reports</title>
  <link rel="stylesheet" href="../css/styles2.css">
</head>

<body>

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
    <td>
      <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="report_id" value="<?php echo $row['id']; ?>">
        <textarea name="doctor_response"><?php echo $row['doctor_response']; ?></textarea>
        <button type="submit">Submit Response</button>
      </form>
    </td>
  </tr>
<?php endwhile; ?>
              
      </tbody>
    </table>
  </div>
</body>

</html>
