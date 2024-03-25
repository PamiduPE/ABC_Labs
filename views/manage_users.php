<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    
        <link rel="stylesheet" href="../css/styles2.css">
        <link rel="stylesheet" href="../css/navigation.css">
        <link rel="stylesheet" href="../css/stylereg.css">

</head>
<body><div class="wrapper">
    <div class="sidebar">
        <h2>ABC Labs</h2>
        
        <ul>
            <li><a href="technician_dashboard.php"><i class="Appointments"></i>Home</a></li>
            <li><a href="manage_users.php"><i class="Users"></i>Users</a></li>
            <li><a href="add_lab_report.php"><i class="Lab Reports"></i>Lab Reports</a></li>
            

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

    <h1>All Users</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th> <!-- Add column for delete action -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Include database connection
            require_once '../includes/db_connection.php';

            // Fetch all users from the database
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);

            // Check if users exist
            if ($result && mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = isset($row['user_id']) ? $row['user_id'] : '';
                    $username = isset($row['username']) ? $row['username'] : '';
                    $email = isset($row['email']) ? $row['email'] : '';
                    $role = isset($row['role']) ? $row['role'] : '';

                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$email</td>";
                    echo "<td>$role</td>";
                    echo "<td><button onclick='confirmDelete($user_id)'>Delete</button></td>"; 
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found.</td></tr>";
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <!-- Hidden form to submit user ID for deletion -->
    <form id="deleteForm" action="delete_user.php" method="POST">
        <input type="hidden" id="userIdToDelete" name="user_id">
    </form>
    <br>
    <br>
    <div class="container">
        <h1>add users</h1>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="../register.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select id="user_type" name="user_type">
                    <option value="patient">Patient</option>
               
                
                    <option value="doctor">Doctor</option>
             
                
                    <option value="technician">Technician</option>
                </select>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            </div>
            <button type="submit">Add User</button>
            
        </form>
    </div>

    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                // Set user ID in hidden form input
                document.getElementById("userIdToDelete").value = userId;
                // Submit form
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
</body>
</html>
