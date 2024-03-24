<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    switch ($_SESSION['user_type']) {
        case 'patient':
            header("Location: views/patient_dashboard.php");
            break;
        case 'doctor':
            header("Location: views/doctor_dashboard.php");
            break;
        case 'technician':
            header("Location: views/technician_dashboard.php");
            break;
        default:
            // Handle unknown user type
            break;
    }
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are provided
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Include database connection
        require_once('includes/db_connection.php');

        // Escape user inputs for security
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        // Retrieve user data from database based on username
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session variables and redirect
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = $row['user_type'];
                
                // Redirect based on user type
                switch ($row['user_type']) {
                    case 'patient':
                        header("Location: views/patient_dashboard.php");
                        break;
                    case 'doctor':
                        header("Location: doctor_dashboard.php");
                        break;
                    case 'technician':
                        header("Location: views/technician_dashboard.php");
                        break;
                    default:
                        // Handle unknown user type
                        break;
                }
                exit;
            } else {
                $error_message = "Invalid username or password.";
            }
        } else {
            $error_message = "Invalid username or password.";
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        // Handle invalid login attempt
        $error_message = "Both username and password are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
        <h1>Login</h1>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <br>
  <p>New user? Sign up <a href="register.php">here</a> to get started.</p>
        </form>
    </div>
</body>
</html>
