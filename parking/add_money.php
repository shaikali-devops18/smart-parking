<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $amount = $_POST["amount"];
    $wal = $_POST['wal'];
    $total = $amount + $wal;

    // Update the user's wallet in the database
    $sql1 = "UPDATE users SET wallet = wallet + $amount WHERE username='$name'";

    if ($conn->query($sql1) === TRUE) {
?>
        <script type="text/javascript">
            window.alert("Successfully added amount to wallet");
            window.location = "dashboard.php";
        </script>
<?php 
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>

        /* CSS for the form */
.admin-dashboard {
    max-width: 500px;
    margin: auto;
    padding: 20px;
}

.car-form {
    display: flex;
    flex-direction: column;
}

.input-field {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}





    </style>
</head>
<body>
   
<header class="header">

<div id="menu-btn" class="fas fa-bars"></div>

<a href="#" class="logo"> <span>Smart</span>Park</a>

<nav class="navbar">
    <a href="dashboard.php">Home</a>
    <!-- <div class="dropdown">
            <a href="">Usedcars</a>
            <div class="dropdown-content">
               <ul><li> <a href="add_salecar.php">Add Car</a></li>
               <li> <a href="manage_salecar.php">Manage Cars</a></li>
                <li><a href="view_request.php">View Requests</a></li>
</ul>
            </div>
        </div>   -->
        <a href="p_areas.php">Parking Ares</a>
        <a href="service_view.php">Booking Status </a>

        <a href="car_view.php">History</a>


    <!-- <div class="dropdown">
            <a href="">services</a>
            <div class="dropdown-content">
               <ul><li> <a href="add_service.php">Add Service</a></li>
               <li> <a href="manage_service.php">Manage Service</a></li>
                <li><a href="view_srequest.php">View Requests</a></li>
</ul>
            </div>
        </div> 
    <div class="dropdown">
            <a href="">Rental Cars</a>
            <div class="dropdown-content">
               <ul><li> <a href="add_car.php">Add Car</a></li>
               <li> <a href="manage_car.php">Manage Cars</a></li>
                <li><a href="view_booking.php">View Bookings</a></li>
</ul>
            </div>
        </div>     -->
    <a href="add_review.php">reviews</a>
</nav>




<div >
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";
Session_start();
// Create connection
$a=$_SESSION['username'];
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from the database
$sql = "SELECT * FROM users where username='$a'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?> 
   <b><p style="font-size:15px;">Wallet: &#8377 <?php echo $row['wallet']; ?> | <a href="add_money.php"><i style="font-size:14px;"class="fa fa-plus"></i></a></p></b>
</div>
<div id="login-btn">
   <a href="logout.php"><button class="btn">Logout</button></a>
    <i class="far fa-user"></i>
</div>

</header> 
    
    <!-- Your admin dashboard content goes here -->
   
    <section class="home">
    <div class="admin-dashboard">
        <form action="" method="post" class="car-form" enctype="multipart/form-data">
        <h1 style="font-size:30px;">Add Money To Wallet</h1><br>
        <input type="hidden" name="wal" value="<?php echo $row['wallet']; ?>" class="input-field" required>
            <input type="hidden" name="name" value="<?php echo $_SESSION['username']; ?>" class="input-field" required>
<center><img src="image/qr.png" style="width:200px;" ></center>
<input type="text" name="amount" placeholder="Enter The Amount" class="input-field" required>
     
            <input type="submit" value="Add Money" class="btn">
        </form>
    </div>
</section>
<section class="footer" id="footer">

<div class="box-container">


    <div class="box">
        <h3>quick links</h3>
        <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> vehicles </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> services </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> featured </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> reviews </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> contact </a>
    </div>

    <div class="box">
        <h3>contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> +44 7438 063137 </a>
        <a href="#"> <i class="fas fa-envelope"></i> vishwanathvenkatesh11@gmail.com </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> City - Country - 000000 </a>
    </div>

    <div class="box">
        <h3>Follow Us</h3>
        <a href="https://www.facebook.com/FreeWebsiteCode"> <i class="fab fa-facebook-f"></i> facebook </a>
        <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
        <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
        <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
        <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a>
    </div>

</div>

<div class="credit"> All Rights Reserved From 2024 By Smart Park </div>

</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>
    <!-- Include your custom scripts here -->
    <script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        document.getElementById('latitude').value = position.coords.latitude;
        document.getElementById('longitude').value = position.coords.longitude;
    }
</script>
</body>
</html>
