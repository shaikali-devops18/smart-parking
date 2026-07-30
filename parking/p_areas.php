<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";
Session_start();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from the database
$sql = "SELECT * FROM parking_area";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    </style>
</head>
<body>
<header class="header">
    <div id="menu-btn" class="fas fa-bars"></div>
    <a href="#" class="logo"> <span>Smart</span>Park</a>
    <nav class="navbar">
        <a href="dashboard.php">Home</a>
        <a href="p_areas.php">Parking Ares</a>
        <a href="service_view.php">Booking Status </a>
        <a href="car_view.php">History</a>
        <a href="add_review.php">reviews</a>
    </nav>
    <div>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "parking";
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
<section class="home">
    <div class="admin-dashboard">
        <h1>Parking Areas</h1>
        <form method="GET" action="">
            <label for="area">Select Area:</label>
            <select name="area" id="area">
                <option value="">All Areas</option>
                <?php
                // Fetch distinct areas from the database
                $area_sql = "SELECT DISTINCT area FROM parking_area";
                $area_result = $conn->query($area_sql);
                if ($area_result->num_rows > 0) {
                    while ($area_row = $area_result->fetch_assoc()) {
                        echo "<option value='" . $area_row['area'] . "'>" . $area_row['area'] . "</option>";
                    }
                }
                ?>
            </select>
            <button type="submit">Search</button>
        </form>
        <button onclick="showNearby()">Show Nearby Parking Areas</button>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Parking Name</th>
                    <th width='20%'>Address</th>
                    <th>Area</th>
                    <th>Price (&#8377) / Hour</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="parking-areas">
            <?php
            // Fetch parking areas from the database based on the selected area
            $selected_area = isset($_GET['area']) ? $_GET['area'] : '';
            if (!empty($selected_area)) {
                $sql = "SELECT * FROM parking_area WHERE area = '$selected_area'";
            } else {
                $sql = "SELECT * FROM parking_area";
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $encoded_address = urlencode($row["address"]);
                    $maps_link = "https://www.google.com/maps/search/?api=1&query={$encoded_address}";
                    echo "<tr>";
                    echo "<td width='300px'><img src='image/" . $row["image"] . "' alt='Parking Image'></td>";
                    echo "<td>" . $row["pname"] . "</td>";
                    echo "<td><a href='$maps_link' target='_blank'>" . $row["address"] . "</a></td>";
                    echo "<td>" . $row["area"] . "</td>";
                    echo "<td> &#8377 " . $row["price"] . " / Hour</td>";
                    echo "<td> <a href='book_parking.php?id=" . $row["id"] . "' class='btn-book'>Book Now</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No parking areas found</td></tr>";
            }
            ?>
            </tbody>
        </table>
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

<script>
function showNearby() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    const userLat = position.coords.latitude;
    const userLng = position.coords.longitude;
    
    // Make an AJAX request to fetch nearby parking areas
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_nearby_parking.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('parking-areas').innerHTML = this.responseText;
        }
    };
    xhr.send('latitude=' + userLat + '&longitude=' + userLng);
}
</script>
</body>
</html>

<?php
$conn->close();
?>
