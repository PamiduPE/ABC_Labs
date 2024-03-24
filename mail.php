<?php
// Override SMTP settings
ini_set("SMTP", "smtp.example.com");
ini_set("smtp_port", "587"); // Use the appropriate port

// Your code for sending emails here
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
</head>
<body>

<h2>Send Email</h2>

<?php
if (isset($_POST['submit'])) {
    $to = $_POST['email'];
    $subject = "Test Email";
    $message = "This is a test email sent from your mail system.";

    // Add headers
    $headers = "From: alexcham1412.com" . "\r\n";
    $headers .= "Reply-To: alexcham1412.com" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Attempt to send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "<p>Email sent successfully!</p>";
    } else {
        echo "<p>Failed to send email. Please try again.</p>";
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email">Email address:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <input type="submit" name="submit" value="Send Email">
</form>

</body>
</html>
