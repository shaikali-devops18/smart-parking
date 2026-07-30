<?php

session_start();
$a=$_SESSION['username'];
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

// Fetch cars from the database
$sql = "SELECT * FROM bookings where username='$a'";
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
$a=$_SESSION['username'];
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from the database
$sql1 = "SELECT * FROM users where username='$a'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
?> 
   <b><p style="font-size:15px;">Wallet: &#8377 <?php echo $row1['wallet']; ?> | <a href="add_money.php"><i style="font-size:14px;"class="fa fa-plus"></i></a></p></b>
</div>
<div id="login-btn">
   <a href="logout.php"><button class="btn">Logout</button></a>
    <i class="far fa-user"></i>
</div>

</header> 
<section class="home">
    <div class="admin-dashboard">
        <h1> Booking History</h1><br>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Parking Name</th>
                    <th>Start Time</th>
                    <th>End Time </th>
                    <th>Total Price</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td width='250px'><img  src='image/" . $row["image"] . "'></td>";
                    echo "<td>" . $row["pname"] . "</td>";
                    echo "<td width='200px'> " . $row["start_time"] . "</td>";
                    echo "<td width='200px'> " . $row["end_time"] . "</td>";
                    echo "<td> &#8377 " . $row["total_price"] . "</td>";
if( $row['status'] == 0){?>
<td style="color:orange">Pending</td>
<?php

}
else if( $row['status'] == 2){?>
    <td style="color:red">Cancelled</td>
    <?php
    
    }else {?>
        <td style="color:green">Completed</td>
        <?php
        
        }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No cars found</td></tr>";
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
</body>
</html>

<?php
$conn->close();
?>
