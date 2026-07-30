<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_name = $_POST["car_name"];
    $car_image = $_FILES["car_image"]["name"];
    $brand = $_POST["brand"];
    $price_per_day = $_POST["price_per_day"];

    // Upload car image to server
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["car_image"]["name"]);
    move_uploaded_file($_FILES["car_image"]["tmp_name"], $target_file);

    // Insert data into database
    $sql = "INSERT INTO cars (car_name, car_image, brand, price_per_day) VALUES ('$car_name', '$car_image', '$brand', '$price_per_day')";

    if ($conn->query($sql) === TRUE) {?>
		<script type="text/javascript">
            window.alert("successfully Car Added");
            window.location="add_car.php";
            </script>
			<?php } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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

<a href="#" class="logo"> <span>Dream</span>Carz</a>

<nav class="navbar">
    <a href="admindashboard.php">Home</a>
    <div class="dropdown">
            <a href="">Usedcars</a>
            <div class="dropdown-content">
               <ul><li> <a href="add_salecar.php">Add Car</a></li>
               <li> <a href="manage_salecar.php">Manage Cars</a></li>
                <li><a href="view_request.php">View Requests</a></li>
</ul>
            </div>
        </div>  
    <div class="dropdown">
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
        </div>    
    <a href="#reviews">reviews</a>
</nav>


<div id="login-btn">
   <a href="logout.php"><button class="btn">Logout</button></a>
    <i class="far fa-user"></i>
</div>

</header>  
    
    <!-- Your admin dashboard content goes here -->
   
    <section class="home">
    <div class="admin-dashboard">
        <form action="" method="post" class="car-form" enctype="multipart/form-data">
        <h1 style="font-size:30px;">Add New Car</h1>

            <input type="text" name="car_name" placeholder="Car Name" class="input-field" required>
            <input type="file" name="car_image" accept="image/*" class="input-field" required>
            <input type="text" name="brand" placeholder="Brand" class="input-field" required>
            <input type="number" name="price_per_day" placeholder="Price per Day ( &#8377 )" class="input-field" required>
            <input type="submit" value="Add Car" class="btn">
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
            <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
            <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
            <a href="#"> <i class="fas fa-envelope"></i> hellofreewebsitecode@gmail.com </a>
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

    <div class="credit"> All Rights Reserved From 2015 By Dream Carz </div>

</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>
    <!-- Include your custom scripts here -->

</body>
</html>
