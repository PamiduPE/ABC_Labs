<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}


require_once('../includes/db_connection.php');

// Get user ID
$technician_id = $_SESSION['user_id'];
$sql_users = "SELECT id, username FROM users";
$result_users = mysqli_query($conn, $sql_users);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Lab Report</title>
  <link rel="stylesheet" href="../css/lab_rp.css">
  <script>

    function showPatientImage() {
      var userId = document.getElementById("user_id").value;
      var patientImageContainer = document.getElementById("patient_image_container");

      // Retrieve the selected patient's pc
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "get_patient_image.php?user_id=" + userId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Insert the retrieved image HTML into the patient image container
          patientImageContainer.innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  </script>
</head>

<body>
  <nav>
    <ul>
      <li>
        <a href="#">Home</a>
      </li>
      <li>
        <a href="#">About</a>
      </li>
      <li>
        <a href="#">Services</a>
      </li>
      <li>
        <a href="#">Contact</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <h1>Add New Lab Report</h1>
    <form action="lab_report_logic.php" method="POST" enctype="multipart/form-data"> <div>
        <label for="user_id">Patient:</label>
        <select name="user_id" id="user_id" onchange="showPatientImage()" required>
          <option value="">Select Patient</option>
          <?php while ($row = mysqli_fetch_assoc($result_users)): ?>
            <option value="<?php echo $row['id']; ?>">
              <?php echo $row['username']; ?>
            </option>
          <?php endwhile; ?>
        </select>
        <div id="patient_image_container">
          </div>
      </div>

      <div>
        <label for="test_type">Test Type:</label>
        <select name="test_type" id="test_type" required>
          <option value="">Select Test Type</option>
          <option value="Blood Test">Blood Test</option>
          <option value="Urine Test">Urine Test</option>
        </select>
      </div>
      <div>
        <label for="created_at">Date:</label>
        <input type="date" name="created_at" id="created_at" required>
      </div>
      <div>
        <label for="report_file">Report File (PDF):</label>
        <input type="file" name="report_file" id="report_file" accept="application/pdf" required>
      </div>
      <div>
        <label for="doctor_response">Doctor Response:</label>
        <textarea name="doctor_response" id="doctor_response" rows="4" required></textarea>
      </div>
      <button type="submit">Submit</button>
    </form>

  </div>
  <script>
  const form = document.querySelector("form");
  form.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    
    fetch("lab_report_logic.php", {
      method: "POST",
      body: new FormData(form) // Send form data
    })
    .then(response => response.text())
    .then(data => {
      if (data.includes("Lab report added successfully.")) {
        
        location.reload();
      } else {
        
        alert("Error: " + data);
      }
    })
    .catch(error => {
      console.error("Error:", error);
    
    });
  });
</script>
</body>

</html>
