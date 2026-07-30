<?php
// Check if car ID is provided and is a valid integer
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $car_id = $_GET['id'];

    // Database connection parameters
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

    // SQL to delete a car from the database
    $sql = "DELETE FROM services WHERE id = $car_id";

    if ($conn->query($sql) === TRUE) {
        ?>
		<script type="text/javascript">
            window.alert("successfully Service Deleted");
            window.location="manage_service.php";
            </script>
			<?php
    } else {
        echo "Error deleting car: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // If car ID is not provided or not a valid integer, redirect to an error page or handle appropriately
    echo "Invalid car ID";
}
?>
