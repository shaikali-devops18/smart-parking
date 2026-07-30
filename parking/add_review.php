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
$sql = "SELECT * FROM bookings where username='$a' and status=0";
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
    /* Style for add-review section */
.add-review {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.add-review h2 {
    margin-bottom: 20px;
    text-align: center;
}

.add-review label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
}

.add-review input[type="text"],
.add-review textarea,
.add-review select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.add-review button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.add-review button:hover {
    background-color: #0d520d;
}

/* Responsive styling */
@media screen and (max-width: 600px) {
    .add-review {
        padding: 10px;
    }
}
#rating-stars i {
            font-size: 50px; /* Adjust the size as needed */
            padding-right:15px;
            color:gold;
            border:black;
        }
        
        /* Your existing CSS styles */
        .add-review {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: grey;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <div class="add-review">
    <h2>Add a Review</h2>
    <form action="submit_review.php" method="post">
        <label for="username">Your Name:</label>
        <input type="text" id="username" name="username" value="<?php echo $a; ?>"required readonly><br><br>
        
        <label for="rating">Rating:</label>
<div id="rating-stars">
    <i class="far fa-star" data-rating="1"></i>
    <i class="far fa-star" data-rating="2"></i>
    <i class="far fa-star" data-rating="3"></i>
    <i class="far fa-star" data-rating="4"></i>
    <i class="far fa-star" data-rating="5"></i>
</div>

<input type="hidden" name="rating" id="rating-value" value="0" required>

<script>
    document.querySelectorAll('#rating-stars i').forEach(function(star) {
        star.addEventListener('mouseenter', function() {
            var rating = parseInt(this.getAttribute('data-rating'));
            highlightStars(rating);
        });

        star.addEventListener('mouseleave', function() {
            var currentRating = parseInt(document.getElementById('rating-value').value);
            highlightStars(currentRating);
        });

        star.addEventListener('click', function() {
            var rating = parseInt(this.getAttribute('data-rating'));
            document.getElementById('rating-value').value = rating;
            highlightStars(rating);
        });
    });

    function highlightStars(rating) {
        document.querySelectorAll('#rating-stars i').forEach(function(star) {
            if (parseInt(star.getAttribute('data-rating')) <= rating) {
                star.classList.add('fas');
                star.classList.remove('far');
            } else {
                star.classList.remove('fas');
                star.classList.add('far');
            }
        });
    }
</script>
<br><br>

        <label for="review">Your Review:</label><br>
        <textarea id="review" name="review" rows="4" required></textarea><br><br>

        <button type="submit">Submit Review</button>
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
</body>
</html>

<?php
$conn->close();
?>



