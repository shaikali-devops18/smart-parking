<?php
session_start();
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

// Check if the ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the booking with the given ID
    $sql = "UPDATE bookings SET status = 2 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the view requests page
 // Redirect back to the view requests page
 echo '<script type="text/javascript">
 window.alert("Request Rejected Successfully");
 window.location="view_request.php";
 </script>';        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "ID parameter not set";
}

$conn->close();
?>
