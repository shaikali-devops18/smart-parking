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

    // Update the status to 1 for the given booking ID
    $sql = "UPDATE bookings SET status = 1 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the view requests page
        echo '<script type="text/javascript">
        window.alert("Request Accepted Successfully");
        window.location="view_request.php";
        </script>';
                exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "ID parameter not set";
}

$conn->close();
?>
