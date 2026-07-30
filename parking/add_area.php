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
    $pname = $_POST["pname"];
    $image = $_FILES["image"]["name"];
    $address = $_POST["address"];
    $slots = $_POST["slots"];

    $price = $_POST["price"];
    $area = $_POST["area"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    // Upload car image to server
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert data into database
    $sql = "INSERT INTO parking_area (pname, image, address, slots, area, price, t_slots, latitude, longitude) 
    VALUES ('$pname', '$image', '$address', '$slots', '$area', '$price', '$slots', '$latitude', '$longitude')";

    if ($conn->query($sql) === TRUE) {?>
		<script type="text/javascript">
            window.alert("successfully Parking Area Added");
            window.location="add_area.php";
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

<a href="#" class="logo"> <span>Smart</span>Park</a>

<nav class="navbar">
    <a href="admindashboard.php">Home</a>
    <div class="dropdown">
            <a href="">Parking Areas</a>
            <div class="dropdown-content">
               <ul><li> <a href="add_area.php">Add Area</a></li>
               <li> <a href="manage_area.php">Manage Area</a></li>
                <li><a href="view_request.php">View Requests</a></li>
</ul>
            </div>
        </div>  
    
        <a href="view_reviews.php">reviews</a>
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
        <h1 style="font-size:30px;">Add Parking Area</h1><br>

            <input type="text" name="pname" placeholder="Parking Name" class="input-field" required>
            <input type="file" name="image" accept="image/*" class="input-field" required>
            <input type="text" name="address" placeholder="Address" class="input-field" required>
            <select name="area" class="input-field" required>
                <option value="">Select area</option>
                <option value="Vijayanagar">Vijayanagar</option>
                <option value="Hebbal">Hebbal</option>
                <option value="Chamundipuram">Chamundipuram</option>
                <option value="Vidyaranyapuram">Vidyaranyapuram</option>
                <option value="Ashokapuram">Ashokapuram</option>
                <option value="Gokulam">Gokulam</option>
                <!-- Add more fuel types as needed -->
            </select>           
            <input type="text" name="slots" placeholder="Total slots" class="input-field" required>
            <input type="number" name="price" placeholder="Amount (&#8377) per Slot" class="input-field" required>
            <input type="text" name="latitude" id="latitude" class="input-field" required>
            <input type="text" name="longitude" id="longitude" class="input-field" required>
            <button type="button" class="btn" onclick="getLocation()">Get Current Location</button>
            <input type="submit" value="Add Area" class="btn">
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
