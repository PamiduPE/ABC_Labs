<?php
session_start();


if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}


require_once('../includes/db_connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  $user_id = $_POST['user_id'];
  $test_type = $_POST['test_type'];
  $doctor_response = $_POST['doctor_response'];
  $report_file_uploaded = isset($_FILES['report_file']) && $_FILES['report_file']['error'] === 0; // Check if file upload attempt was made and no errors occurred

  $file_name = '';
  $file_destination = '';


  if ($report_file_uploaded) {
  
    $upload_dir = "../uploads/";
    $allowed_extensions = array('pdf', 'docx', 'jpg', 'jpeg', 'png'); // Define allowed extensions
    $file_ext = pathinfo($_FILES['report_file']['name'], PATHINFO_EXTENSION);

    // Validate file type
    if (!in_array($file_ext, $allowed_extensions)) {
      echo "Error: Invalid file type. Please upload a PDF, DOCX, JPG, JPEG, or PNG file.";
      exit;
    }

    // Sanitize
    $file_name = time() . '_' . sanitize_filename($_FILES['report_file']['name']);

    $file_destination = $upload_dir . $file_name;
    move_uploaded_file($_FILES['report_file']['tmp_name'], $file_destination);
  } else {
    
  }

 
  $sql = "INSERT INTO lab_report (user_id, test_type, report_file, doctor_response)
          VALUES (?, ?, ?, ?)";


  $stmt = mysqli_prepare($conn, $sql);
  $report_file_to_bind = $report_file_uploaded ? $file_name : null; 
  mysqli_stmt_bind_param($stmt, "isss", $user_id, $test_type, $report_file_to_bind, $doctor_response);

  
  if (mysqli_stmt_execute($stmt)) {

    echo "Lab report added successfully.";
  } else {

    echo "Error: " . mysqli_error($conn);
   
  }


  mysqli_stmt_close($stmt);
}


mysqli_close($conn);


function sanitize_filename($filename) {
  $characters = array(" ", "-", "_", ".", "~"); // Allowed characters
  $sanitized = preg_replace('/[^a-zA-Z0-9'.implode('', $characters).']/', '', $filename);
  return strtolower($sanitized);
}
