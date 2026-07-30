<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if(isset($_SESSION["username"])) {

    // Verify OTP
    
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $phone = $_SESSION['phone'];

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert data into database
        $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            // Registration success
            echo '<script type="text/javascript">
                window.alert("Registration Successful");
                window.location="index.php";
                </script>';
        } else {
            // Registration failed
            echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '");</script>';
        }

        // Clear session data
        session_unset();
        session_destroy();
    } else {
        // Invalid OTP
        echo '<script>alert("Invalid OTP. Please try again.");</script>';
    }

    // Close database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Verify OTP</title>
</head>
<body>



<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
