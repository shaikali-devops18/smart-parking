<?php

require('auth.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";

}

// Assuming the connection to the database is established
if(isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Change your SQL query to use prepared statements
    $sqli = "SELECT * FROM parking_area WHERE id = ?";
    $stmt1 = $conn->prepare($sqli);
    $stmt1->bind_param("i", $car_id); // 'i' indicates integer type
    $stmt1->execute();
    $result = $stmt1->get_result();
   
} else {
    echo "Invalid car ID<br>";
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

form {
            margin: 10px auto;
            max-width: 700px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="date"] {
            width: calc(80% - 5px);
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #priceDisplay {
            margin-top: 20px;
            font-weight: bold;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
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
            flex: 4; /* Grow to fill remaining space */
        }

        .car-details h1 {
            font-size: 40px;
            margin-top: 0;
        }

        .car-details p {
            font-size: 20px;
        }
        .btn-book {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-book:hover {
            background-color: #0056b3;
        }
        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
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
// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch cars from the database
$sql123 = "SELECT * FROM users where username='$a'";
$result1 = $con->query($sql123);
$row = $result1->fetch_assoc();
?> 
   <b><p style="font-size:15px;">Wallet: &#8377 <?php echo $row['wallet']; ?> | <a href="add_money.php"><i style="font-size:14px;"class="fa fa-plus"></i></a></p></b>
</div>
<div id="login-btn">
   <a href="logout.php"><button class="btn">Logout</button></a>
    <i class="far fa-user"></i>
</div>

</header> 
<section class="home">
<div class="admin-dashboard">
        <?php
        if ($result->num_rows > 0) {
            // Output data of the selected car
            $car = $result->fetch_assoc();
            $encoded_address = urlencode($car["address"]);
                        $maps_link = "https://www.google.com/maps/search/?api=1&query={$encoded_address}";
                        
            // Display car image and details
            echo "<div class='car-image1'><img src='image/" . $car['image'] . "' alt='" . $car['pname'] . "' width='600px'></div>";
            echo "<div class='car-details'>";
            echo "<h1 style='font-size:30px;'>" . $car['pname'] . "</h1>";
            echo "<hr>"; // Divider line
            echo "<b><p>Address: <a href='$maps_link' target='_blank'>" . $car["address"] . "</a></p>";
            echo "<hr>"; // Divider line
            echo "<h1 style='font-size:20px;'>" . $car['slots'] . " Slots Available</h1>";
            echo "<hr>"; // Divider line
            echo "<p style='font-size:15px;color:red;'> ₹" . $car['price'] . " / Hour</p></b>";

            ?>
            <!-- Date selection for start and end dates -->
            <form id="bookingForm" action="process_booking.php" method="POST">
                <label for="startDate">Start Time:</label>
                <input type="time" id="starttime" name="start_time" required>
                <br>
                <label for="endDate">End Time:</label>
                <input type="time" id="endtime" name="end_time" required>
                <br>
                <!-- Hidden input fields to store car details -->
                <input type="hidden" id="carId" name="car_id" value="<?php echo $car['id']; ?>">
                <input type="hidden" id="carName" name="car_name" value="<?php echo $car['pname']; ?>">
                <input type="hidden" id="carPrice" name="car_price" value="<?php echo $car['price']; ?>">
                <input type="hidden" id="carImage" name="car_image" value="<?php echo $car['image']; ?>">
                <input type="hidden" id="slots" name="slots" value="<?php echo $car['slots']; ?>">
                <input type="hidden" id="username" name="username" value="<?php echo $a; ?>">

                <!-- Display the calculated price -->
                <div id="priceDisplay"></div><br>
                <!-- Submit button -->
                <input type="submit" class="btn-book"name="submit" value="Book Now">
            </form>
            <?php
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

<script>
    // Function to calculate the price based on selected times
    function calculatePrice() {
        var carPrice = parseFloat(document.getElementById('carPrice').value);
        var startTime = document.getElementById('starttime').value;
        var endTime = document.getElementById('endtime').value;

        if (startTime && endTime) {
            var start = new Date("1970-01-01T" + startTime + "Z");
            var end = new Date("1970-01-01T" + endTime + "Z");

            var timeDiff = (end - start) / (1000 * 60 * 60); // Difference in hours
            if (timeDiff < 0) {
                timeDiff += 24; // Handle cases where end time is past midnight
            }

            var totalPrice = carPrice * timeDiff;
            document.getElementById('priceDisplay').innerText = 'Total Price: ₹' + totalPrice.toFixed(2);
        }
    }

    // Add event listeners to time inputs to recalculate price when times are changed
    document.getElementById('starttime').addEventListener('change', calculatePrice);
    document.getElementById('endtime').addEventListener('change', calculatePrice);

    // Initially calculate the price when the page loads
    calculatePrice();
</script>
    </script>
</body>
</html>

<?php
$conn->close();
?>

