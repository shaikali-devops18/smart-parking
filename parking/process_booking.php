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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $car_price = $_POST['car_price'];
    $car_image = $_POST['car_image'];
    $slots = $_POST['slots'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $user = $_POST['username'];

    // Calculate total price
    $start = new DateTime($start_time);
    $end = new DateTime($end_time);
    $interval = $start->diff($end);
    $hours = $interval->h + ($interval->days * 24);
    $total_price = $car_price * $hours;

    // Check if the user has already booked a slot for the given time period
    $sql_check = "SELECT * FROM bookings WHERE pid = ? AND ((start_time <= ? AND end_time > ?) OR (start_time < ? AND end_time >= ?)) AND username= ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("isssss", $car_id, $end_time, $start_time, $end_time, $start_time,$user);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo '<script type="text/javascript">
        window.alert("You have already booked a slot for this time period.");
        window.location="p_areas.php";
        </script>';
    } else {
        // Insert booking data into bookings table
        $sql_insert = "INSERT INTO bookings (pid, pname, price, image, start_time, end_time, username, total_price) 
                       VALUES (?, ?, ?, ?, ?, ?, ?,?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("isisssss", $car_id, $car_name, $car_price, $car_image, $start_time, $end_time, $user, $total_price);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            // Decrement the available slots in parking_area table
            $sql_update = "UPDATE parking_area SET slots = slots - 1 WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("i", $car_id);
            $stmt_update->execute();

            if ($stmt_update->affected_rows > 0) {
                echo '<script type="text/javascript">
                window.alert("Slot Booking Successful");
                window.location="p_areas.php";
                </script>';
            } else {
                echo "Booking successful but failed to update slot.";
            }
        } else {
            echo "Failed to create booking.";
        }

        $stmt_insert->close();
        $stmt_update->close();
    }

    $stmt_check->close();
}

$conn->close();
?>
