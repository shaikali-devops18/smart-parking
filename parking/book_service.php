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

// Check if the service id is provided in the URL
if(isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Retrieve service details for the booked service
    $sql = "SELECT * FROM services WHERE id = $service_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Assuming service exists, retrieve service details
        $service = $result->fetch_assoc();
        $service_name = $service["service_name"];
        $price = $service["price"];

        // You might want to perform additional validation here, such as checking if the service id exists in the database

        // Assuming the service id is valid, you can proceed with booking the service

        // Collect user input (name and email) - You might want to add more robust validation here
        $user_name = $_SESSION['username'];

        // Insert booking details into requests table
        $insert_sql = "INSERT INTO srequests (serviceid, username) VALUES ($service_id, '$user_name')";
        if ($conn->query($insert_sql) === TRUE) {
            // Booking successful
            echo "<script>alert('Booking Request Sent Successfully');</script>";
        echo "<script>window.location='service_view.php';</script>";
           
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Service not found.";
    }
} else {
    // If the service id is not provided in the URL, redirect the user back to the services page
    header("Location: service_view.php");
    exit(); // Make sure to exit after redirection
}

$conn->close();
?>
