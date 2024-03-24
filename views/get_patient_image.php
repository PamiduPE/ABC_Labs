<?php
require_once ('../includes/db_connection.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "SELECT profile_picture FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $profile_picture = $row['profile_picture'];

        // Prepend the correct relative path to the image directory
        $image_path = "../" . $profile_picture;

        echo "<img src='$image_path' alt='Patient Image' class='rounded-image'>";
    } else {
        echo "No image found for this patient.";
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
