<?php
session_start();

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

// Assuming the connection to the database is established
if(isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Change your SQL query to use prepared statements
    $sql = "SELECT * FROM carsale WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id); // 'i' indicates integer type
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    echo "Invalid car ID";
}
?>

<?php
if(isset($_POST['car_id'], $_POST['username'], $_POST['car_name'], $_POST['car_price'], $_POST['car_image'], $_POST['fuel_type'], $_POST['model'])) {
    $car_id = $_POST['car_id'];
    $username = $_POST['username'];
    $car_name = $_POST['car_name'];
    $car_price = $_POST['car_price'];
    $car_image = $_POST['car_image'];
    $fuel_type = $_POST['fuel_type'];
    $model = $_POST['model'];

    // Insert the booking details into the database
    $sql = "INSERT INTO bookings (car_id, username, car_name, car_price, car_image, fuel_type, model) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $car_id, $username, $car_name, $car_price, $car_image, $fuel_type, $model);
    if ($stmt->execute()) {
        echo "<script>alert('Booking Request Sent Successfully');</script>";
        echo "<script>window.location='car_view.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
<style>
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px; /* Adjust font size as needed */

        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td a {
            color: #007bff;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .btn-edit {
            background-color: #28a745;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.8;
        }

        .admin-dashboard img {
            max-width: 800px; /* Adjust the maximum width as needed */
            height: auto;
        }

        .admin-dashboard {
            display: flex;
            align-items: center; /* Vertically align contents */
            max-width: 1000px; /* Adjust maximum width as needed */
            margin: auto;
            padding: 20px;
        }

        .car-image1 {
            width:550px;
            flex: 0 0 auto; /* Don't grow or shrink */
            margin-right: 200px; /* Adjust margin as needed */
        }

        .car-details {
            flex: 1; /* Grow to fill remaining space */
        }

        .car-details h1 {
            font-size: 40px;
            margin-top: 0;
        }

        .car-details p {
            font-size: 20px;
        }
    </style>
</head>
<body>
<header class="header">

<div id="menu-btn" class="fas fa-bars"></div>

<a href="#" class="logo"> <span>Dream</span>Carz</a>

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
        <a href="car_view.php">Used Cars</a>
        <a href="service_view.php">Services </a>
        <a href="rent_car_view.php">Rental Cars </a>

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


<div id="login-btn">
   <a href="logout.php"><button class="btn">Logout</button></a>
    <i class="far fa-user"></i>
</div>

</header><section class="home">
        <div class="admin-dashboard">
            <?php
            if ($result->num_rows > 0) {
                // Output data of the selected car
                $car = $result->fetch_assoc();
                // Display car image and details
                echo "<div class='car-image1'><img src='image/" . $car['car_image'] . "' alt='" . $car['car_name'] . "' width='800px'></div>";
                echo "<div class='car-details'>";
                echo "<h1 style='font-size:35px;'>" . $car['car_name'] . "</h1>";
                echo "<b><p style='font-size:30px;'>Brand: " . $car['brand'] . "</p>";
                echo "<p style='font-size:25px;'>Fuel Type: " . $car['fuel_type'] . "</p>";
                echo "<p style='font-size:20px;'>Model Year: " . $car['model'] . "</p>";
                echo "<p style='font-size:35px;'> ₹" . $car['price'] . "</p></b>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='car_id' value='" . $car['id'] . "'>";
                echo "<input type='hidden' name='username' value='" . (isset($_SESSION['username']) ? $_SESSION['username'] : '') . "'>";
                echo "<input type='hidden' name='car_name' value='" . $car['car_name'] . "'>";
                echo "<input type='hidden' name='car_price' value='" . $car['price'] . "'>";
                echo "<input type='hidden' name='car_image' value='" . $car['car_image'] . "'>";
                echo "<input type='hidden' name='fuel_type' value='" . $car['fuel_type'] . "'>";
                echo "<input type='hidden' name='model' value='" . $car['model'] . "'>";
                echo "<button type='submit'>Book Now</button>";
                echo "</form>";
                echo "</div>";
                // Add more details as needed
            } else {
                echo "Car not found";
            }
            ?>
        </div>
    </section>

<footer class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick Links</h3>
            <a href="#">Home</a>
            <a href="#">Vehicles</a>
            <a href="#">Services</a>
            <a href="#">Featured</a>
            <a href="#">Reviews</a>
            <a href="#">Contact</a>
        </div>
        <div class="box">
            <h3>Contact Info</h3>
            <a href="#">+123-456-7890</a>
            <a href="#">+111-222-3333</a>
            <a href="#">hellofreewebsitecode@gmail.com</a>
            <a href="#">City - Country - 000000</a>
        </div>
        <div class="box">
            <h3>Follow Us</h3>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
            <a href="#">Linkedin</a>
            <a href="#">Pinterest</a>
        </div>
    </div>
    <div class="credit">All Rights Reserved From 2015 By Dream Carz</div>
</footer>

</body>
</html>

<?php
$conn->close();
?>

