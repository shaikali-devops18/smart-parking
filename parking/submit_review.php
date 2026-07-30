<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    // Validate form data (you can add more validation as needed)
    if (empty($username) || empty($rating) || empty($review)) {
        // Handle empty fields error (redirect or display error message)
        header("Location: add_review.php?error=empty_fields");
        exit();
    }

    // Database connection parameters
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "parking";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert review into the database
    $sql = "INSERT INTO reviews (username, rating, review) VALUES ('$username', '$rating', '$review')";

    if ($conn->query($sql) === TRUE) {
        // Review added successfully
        echo '<script type="text/javascript">
        window.alert("Review Successfully Added");
        window.location="dashboard.php";
        </script>';
                exit();
    } else {
        // Handle database error (redirect or display error message)
        header("Location: add_review.php?error=db_error");
        exit();
    }

    // Close database connection
    $conn->close();
} else {
    // If the form wasn't submitted, redirect to the form page
    header("Location: add_review.php");
    exit();
}
?>
