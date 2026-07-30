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

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Update the booking status to 2 (cancelled)
    $sql_update = "UPDATE bookings SET status = 2 WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("i", $booking_id);
    $stmt_update->execute();

    if ($stmt_update->affected_rows > 0) {
        echo '<script type="text/javascript">
        window.alert("Booking Cancelled Successfully");
        window.location="p_areas.php";
        </script>';
    } else {
        echo "Failed to cancel booking.";
    }

    $stmt_update->close();
}

$conn->close();
?>
