
<?php include 'patient_dashboard.logic.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navigation.css">
</head>
<body>


    
    <div class="container">
        <div class="pro_container">
        <?php if (isset($user_info['username'])): ?>
            <section class="profile_container">
                <div class="profile_desc_section">
                    <!-- Add this button where you want the logout button to appear -->
<form action="../logout.php" method="post">
    <button type="submit" name="logout">Logout</button>
</form>

                    <h1>Welcome, <?php echo $user_info['username']; ?>!</h1>
                    <div>
                    <div class="profile-picture">
    <?php if ($profile_picture): ?>
        <img src="<?php echo $profile_picture; ?>" class="profile-picture-img" alt="Profile Picture">
    <?php else: ?>
        <img src="images/male-profile-picture-vector.jpg" class="profile-picture-img" alt="Default Profile Picture">
    <?php endif; ?>
</div></div></div></div>
<br>
<br>
                    <!-- Appointments -->
                    <h2>Your Appointments:</h2>
                    
<br>
                    <?php if (isset($appointments) && count($appointments) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Test Type</th>
                                    <th>status</th>
                                    <th>notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr>
                                        <td><?php echo $appointment['date']; ?></td>
                                        <td><?php echo $appointment['time']; ?></td>
                                        <td><?php echo $appointment['test_type']; ?></td>
                                        <td><?php echo $appointment['status']; ?></td>
                                        <td><?php echo $appointment['note']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p><?php echo $error_message; ?></p>
                    <?php endif; ?>

                   
            </section>
        <?php else: ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>

    <div class="container">
        <h2>Add New Appointment</h2>
        <div class="formbold-main-wrapper">
            <div class="formbold-form-wrapper">
            <form action="add_appointment.php" method="POST">
    <div class="formbold-mb-5">
        <label for="date" class="formbold-form-label">Date</label>
        <input type="date" name="date" id="date" class="formbold-form-input" required>
    </div>
    <div class="formbold-mb-5">
        <label for="time" class="formbold-form-label">Time</label>
        <input type="time" name="time" id="time" class="formbold-form-input" required>
    </div>
    <div class="formbold-mb-5">
        <select id="test_type" name="test_type" required>
            <option value="Blood Test">Blood Test</option>
            <option value="Urine Test" i>Urine Test</option>
            <option value="X-Ray">X-Ray</option>
        </select>
    </div>
    <div>
        <button class="formbold-btn" type="submit">Add Appointment</button>
    </div>
</form>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/nav.js"></script>
</body>11
</html>
