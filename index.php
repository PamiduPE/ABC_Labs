<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 7px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .navbar {
            background-color: #6a64f1;
            padding: 20px 0;
            text-align: center;
            
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .navbar ul li {
            display: inline-block;
            margin-right: 20px;
        }
        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        .navbar ul li a:hover {
            background-color: #524bd4;
        }
        .hero {
            background-color: #6a64f1;
            color: #fff;
            padding: 50px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 18px;
            margin-bottom: 40px;
        }
        .btn {
            display: inline-block;
            background-color: #6a64f1;
            color: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #524bd4;
        }
        .features {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .feature {
            flex: 1;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .feature h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .feature p {
            font-size: 16px;
            color: #555;
        }
        /* Existing CSS styles */
.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-end; /* Align items to the right */
}

.navbar ul li {
    margin-right: 20px;
}

/* New styles for the signup button */
.signup {
    margin-left: auto; /* Push the signup button to the right */
}

.signup a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
    padding: 10px 20px;
    border-radius: 6px;
    background-color: #6a64f1;
    transition: background-color 0.3s ease;
}

.signup a:hover {
    background-color: #524bd4;
}

    </style>
</head>
<body>
    
<div class="container">
        <div class="navbar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
                <li class="signup"><a href="login.php">Sign in</a></li>
            </ul>
        </div>
        <div class="hero">
            <h1>Welcome to ABC Labs</h1>
            <p>Where quality meets service.</p>
            <a href="views/Patient_dashboard.php" class="btn">Make an appointment</a>
        </div>
        <div class="features">
            <div class="feature">
                <h2>Quality Service</h2>
                <p>We offer top-notch services to meet your needs.</p>
            </div>
            <div class="feature">
                <h2>Expert Staff</h2>
                <p>Our team of professionals is dedicated to serving you.</p>
            </div>
            <div class="feature">
                <h2>Customer Satisfaction</h2>
                <p>Your satisfaction is our priority.</p>
            </div>
        </div>
    </div>
</body>
</html>
