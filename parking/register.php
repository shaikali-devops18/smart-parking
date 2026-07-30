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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    // Store user details in session
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['phone'] = $phone;

    

    // Redirect to OTP verification page
    header("Location: verify_otp.php");
    exit();
}
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
    <title>Register</title>
</head>
<body>

<div class="login-form-container active">
    <span class="fas fa-times"></span>
    <form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Registration</h3>
        <input type="text" name="username" placeholder="Username" class="box" required>
        <input type="email" name="email" placeholder="E-mail" class="box" required>
        <input type="password" name="password" placeholder="Password" class="box" required>
        <input type="text" name="phone" placeholder="Phone Number" class="box" required>
        <input type="submit" value="Register" class="btn">
        <p>Back to Home <a href="index.php">Click Here</a></p>
    </form>
</div>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
