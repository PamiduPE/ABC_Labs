<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointments</title>
  <link rel="stylesheet" href="../css/styles2.css">
</head>
<body>
  
  <div class="container">
    <div class="table-container">
      <table class="appointment-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Patient ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Test Type</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Note</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require_once ('../includes/db_connection.php');
            
    


    

            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
    
            if(isset($_POST['update'])) {
              $id = $_POST['id'];
              $status = $_POST['status'];
              $note = $_POST['note'];

              $sql = "UPDATE appointments SET status='$status', note='$note' WHERE id=$id";

              if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . mysqli_error($conn);
              }
            }
    
            $sql = "SELECT * FROM appointments";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["patient_id"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["time"] . "</td>";
                echo "<td>" . $row["test_type"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["note"] . "</td>";
                echo "<td>
                        <form method='post'>
                          <input type='hidden' name='id' value='" . $row['id'] . "'>
                          <input type='radio' name='status' value='accepted'> Accepted<br>
                          <input type='radio'  name='status' value='declined'> Declined<br>
                          <input type='radio' name='status' value='pending'> Pending<br>
                          <input type='text' name='note' value='" . $row['note'] . "'><br>
                          <input type='submit' name='update' value='Update'>
                        </form>
                      </td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='9'>No appointments found</td></tr>";
            }
            mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="container">
    <a href="add_lab_report.php" class="button">Add Lab Report</a>
  </div>
</body>
</html>
