<?php include 'technician_dashboard.logic.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, Doctor!</h1>
        <p>This is the doctor dashboard.</p>
        
        <!-- Doctor-specific content -->
        <h2>Appointments</h2>
        <ul>
            <li>View upcoming appointments</li>
            <li>Manage appointment schedule</li>
            <li>View patient test results</li>
        </ul>
        
        <h2>Patients</h2>
        <ul>
            <li>View patient records</li>
            <li>Update patient information</li>
            <li>Order new tests for patients</li>
        </ul>
        
        <div class="logout-link">
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
