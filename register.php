<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: views/patient_dashboard.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['user_type'])) {
     
        require_once('includes/db_connection.php');

 
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $user_type = $_POST['user_type'];

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error_message = "Username already exists.";
        } else {

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $error_message = "File is not an image.";
                    $uploadOk = 0;
                }
            }


            if ($_FILES["profile_picture"]["size"] > 500000) {
                $error_message = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

      
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

    
            if ($uploadOk == 0) {
                $error_message = "Sorry, your file was not uploaded.";
           
            } else {
                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                   
                    $sql = "INSERT INTO users (username, password, email, profile_picture, user_type) VALUES ('$username', '$password', '$email', '$target_file', '$user_type')";
                    if (mysqli_query($conn, $sql)) {
                      
                        header("Location: login.php");
                        exit;
                    } else {
                        $error_message = "Error: " . mysqli_error($conn);
                    }
                } else {
                    $error_message = "Sorry, there was an error uploading your file.";
                }
            }

        }

        // Close database connection
        mysqli_close($conn);
    } else {
        // Handle invalid registration attempt
        $error_message = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/stylereg.css">
</head>
<body>
<div class="container">
        <h1>Register</h1>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
                </select>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            </div>
            <button type="submit">Register</button>
            <p>Already registered? Log In <a href="login.php">here</a> to get started.</p>
        </form>
    </div>
</body>
</html>
